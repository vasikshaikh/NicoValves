<?php

namespace App\Http\Controllers;

use App\Models\ProductInfo;
use App\Models\CategoryInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function listProduct(Request $request)
    {
        $q = $request->input('q');
        $length = $request->input('length', 10);

        $product_data = ProductInfo::with('category')
            ->when($q, function ($query, $q) {
                $query->where(function ($q2) use ($q) {
                    $q2->where('title', 'like', "%{$q}%")
                        ->orWhereHas('category', function ($c) use ($q) {
                            $c->where('name', 'like', "%{$q}%");
                        });
                });
            })
            ->orderBy('id', 'desc')
            ->paginate($length)
            ->withQueryString();

        return view('Product.list_product', compact('product_data'));
    }

    public function saveProduct(Request $request)
    {
        if ($request->category_id == "0") {
            $request->merge(['category_id' => null]);
        }

        $request->validate([
            'category_id' => 'nullable|exists:category_infos,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'document' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $data = $request->only('category_id', 'title', 'description');

        if ($request->hasFile('image')) {
            $images = [];
            foreach ($request->file('image') as $img) {
                if ($img) {
                    $filename = time() . '_' . uniqid() . '_' . $img->getClientOriginalName();
                    $img->move(public_path('productImage'), $filename);
                    $images[] = $filename;
                }
            }
            if (!empty($images)) {
                $data['image'] = json_encode($images);
            }
        }

        if ($request->hasFile('document')) {
            $doc = $request->file('document');
            $filename = time() . '_' . uniqid() . '_' . $doc->getClientOriginalName();
            $doc->move(public_path('ProductDocument'), $filename);
            $data['document'] = $filename;
        }

        ProductInfo::create($data);

        return redirect()->route('listProduct')->with('success', 'Product added successfully!');
    }

    public function editProduct($id)
    {
        $product = ProductInfo::findOrFail($id);
        return response()->json([
            'id' => $product->id,
            'title' => $product->title,
            'description' => $product->description,
            'category_id' => $product->category_id,
            'image' => $product->image,
            'document' => $product->document,
        ]);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = ProductInfo::findOrFail($id);

        // Handle "0" category selection
        if ($request->category_id == "0") {
            $request->merge(['category_id' => null]);
        }

        $request->validate([
            'category_id' => 'nullable|exists:category_infos,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $data = $request->only('category_id', 'title', 'description');

        // Handle image updates
        $currentImages = $product->image ? json_decode($product->image, true) : [];

        // Get images to remove from hidden input
        $imagesToRemove = $request->input('remove_images', []);

        if (!empty($imagesToRemove)) {
            // Convert to array if it's a string
            if (is_string($imagesToRemove)) {
                $imagesToRemove = explode(',', $imagesToRemove);
            }

            // Remove selected images
            foreach ($imagesToRemove as $imageToRemove) {
                if (($key = array_search($imageToRemove, $currentImages)) !== false) {
                    // Delete physical file
                    if (File::exists(public_path('productImage/' . $imageToRemove))) {
                        File::delete(public_path('productImage/' . $imageToRemove));
                    }
                    // Remove from array
                    unset($currentImages[$key]);
                }
            }

            // Reindex array after removal
            $currentImages = array_values($currentImages);
        }

        // Add new images
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $newImage) {
                if ($newImage->isValid()) {
                    $filename = time() . '_' . uniqid() . '_' . $newImage->getClientOriginalName();
                    $newImage->move(public_path('productImage'), $filename);
                    $currentImages[] = $filename;
                }
            }
        }

        // Update image data
        $data['image'] = !empty($currentImages) ? json_encode($currentImages) : null;

        // Handle document update
        if ($request->hasFile('document')) {
            if ($request->file('document')->isValid()) {
                // Delete old document
                if ($product->document && File::exists(public_path('ProductDocument/' . $product->document))) {
                    File::delete(public_path('ProductDocument/' . $product->document));
                }

                $document = $request->file('document');
                $filename = time() . '_' . uniqid() . '_' . $document->getClientOriginalName();
                $document->move(public_path('ProductDocument'), $filename);
                $data['document'] = $filename;
            }
        }

        $product->update($data);

        return redirect()->route('listProduct')->with('success', 'Product updated successfully!');
    }

    public function deleteProduct($id)
    {
        $product = ProductInfo::findOrFail($id);

        if ($product->image) {
            foreach (json_decode($product->image) as $img) {
                if (File::exists(public_path('productImage/' . $img))) {
                    File::delete(public_path('productImage/' . $img));
                }
            }
        }

        if ($product->document && File::exists(public_path('ProductDocument/' . $product->document))) {
            File::delete(public_path('ProductDocument/' . $product->document));
        }

        $product->delete();

        return redirect()->route('listProduct')->with('success', 'Product deleted successfully!');
    }
}
