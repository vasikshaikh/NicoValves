<?php

namespace App\Http\Controllers;

use App\Models\CategoryInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function addCategory()
    {
        return redirect()->route('listCategory', ['open' => 'add']);
    }

    public function searchCategory(Request $request)
    {
        $q = $request->input('q');

        $categories = CategoryInfo::where('name', 'like', "%{$q}%")
            ->select('id', 'name')
            ->limit(10)
            ->get();

        return response()->json($categories);
    }

    public function saveCategory(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $category = new CategoryInfo();
        $category->name = $request->name;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('CategoryImage'), $filename);
            $category->image = $filename;
        }

        $category->save();

        return redirect()->route('listCategory')->with('success', 'Category added successfully!');
    }

    public function listCategory(Request $request)
    {
        $query = CategoryInfo::query();

        if ($request->q) {
            $query->where('name', 'like', "%{$request->q}%");
        }

        $length = $request->length ?? 10;

        $category_data = $query->orderBy('id', 'desc')->paginate($length)->withQueryString();

        return view('Category.list_category', compact('category_data'));
    }

    public function editCategory($id)
    {
        $category = CategoryInfo::findOrFail($id);
        return response()->json($category);
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $category = CategoryInfo::findOrFail($id);
        $category->name = $request->name;

        if ($request->hasFile('image')) {
            if ($category->image && File::exists(public_path('CategoryImage/' . $category->image))) {
                File::delete(public_path('CategoryImage/' . $category->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('CategoryImage'), $filename);
            $category->image = $filename;
        }

        $category->save();

        return redirect()->route('listCategory')->with('success', 'Category updated successfully!');
    }

    public function deleteCategory($id)
    {
        $category = CategoryInfo::findOrFail($id);

        if ($category->image && File::exists(public_path('CategoryImage/' . $category->image))) {
            File::delete(public_path('CategoryImage/' . $category->image));
        }

        $category->delete();

        return redirect()->route('listCategory')->with('success', 'Category deleted successfully!');
    }
}
