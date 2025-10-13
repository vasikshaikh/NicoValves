<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUsInfo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AboutUsController extends Controller
{
    public function addAboutUs()
    {
         return redirect()->route('listAboutUs', ['open' => 'add']);
    }

    public function listAboutUs(Request $request)
    {
        $q = $request->query('q');
        $length = (int) $request->query('length', 10);
        if ($length <= 0) $length = 10;

        $about_data = AboutUsInfo::when($q, function($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%");
            })
            ->latest()
            ->paginate($length);

        $about_data->appends($request->only(['q','length']));

        return view('AboutUs.list_aboutus', compact('about_data'));
    }

    public function saveAboutUs(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $savedNames = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (!$file || !$file->isValid()) continue;

                $orig = $file->getClientOriginalName();
                $orig = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $orig);

                $targetPath = public_path('AboutImage') . DIRECTORY_SEPARATOR . $orig;
                if (File::exists($targetPath)) {
                    $storedName = time() . '_' . uniqid() . '_' . $orig;
                } else {
                    $storedName = $orig;
                }

                if (!File::exists(public_path('AboutImage'))) {
                    File::makeDirectory(public_path('AboutImage'), 0755, true);
                }

                $file->move(public_path('AboutImage'), $storedName);

                $savedNames[] = $storedName;
                if (count($savedNames) >= 5) break;
            }
        }

        AboutUsInfo::create([
            'title' => $request->title,
            'description' => $request->description ?? '',
            'image' => $savedNames,
        ]);

        return redirect()->route('listAboutUs')->with('success', 'About Us entry added successfully!');
    }

    public function editAboutUs($id)
    {
        $about = AboutUsInfo::findOrFail($id);

        return response()->json([
            'id' => $about->id,
            'title' => $about->title,
            'description' => $about->description,
            'image' => is_array($about->image) ? $about->image : ( $about->image ? (array) $about->image : [] ),
        ]);
    }

    public function updateAboutUs(Request $request, $id)
    {
        $about = AboutUsInfo::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'string',
        ]);

        $images = is_array($about->image) ? $about->image : [];

        $toRemove = $request->input('remove_images', []);
        if (!empty($toRemove) && is_array($toRemove)) {
            foreach ($toRemove as $remName) {
                $key = array_search($remName, $images, true);
                if ($key !== false) {
                    $fullPath = public_path('AboutImage') . DIRECTORY_SEPARATOR . $remName;
                    if (File::exists($fullPath)) {
                        @unlink($fullPath);
                    }
                    array_splice($images, $key, 1);
                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (! $file || ! $file->isValid()) continue;
                if (count($images) >= 5) break; 
                $orig = $file->getClientOriginalName();
                $orig = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $orig);

                $targetPath = public_path('AboutImage') . DIRECTORY_SEPARATOR . $orig;
                if (File::exists($targetPath)) {
                    $storedName = time() . '_' . uniqid() . '_' . $orig;
                } else {
                    $storedName = $orig;
                }

                if (!File::exists(public_path('AboutImage'))) {
                    File::makeDirectory(public_path('AboutImage'), 0755, true);
                }

                $file->move(public_path('AboutImage'), $storedName);
                $images[] = $storedName;
            }
        }

        $about->update([
            'title' => $request->title,
            'description' => $request->description ?? '',
            'image' => $images,
        ]);

        return redirect()->route('listAboutUs')->with('success', 'About Us updated successfully!');
    }

    public function deleteAboutUs($id)
    {
        $about = AboutUsInfo::findOrFail($id);

        if (!empty($about->image) && is_array($about->image)) {
            foreach ($about->image as $img) {
                $path = public_path('AboutImage') . DIRECTORY_SEPARATOR . $img;
                if (File::exists($path)) {
                    @unlink($path);
                }
            }
        }

        $about->delete();

        return redirect()->route('listAboutUs')->with('success', 'About Us entry deleted.');
    }
}
