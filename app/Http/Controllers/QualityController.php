<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QualityInfo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class QualityController extends Controller
{
    public function addQuality()
    {
        return redirect()->route('listQuality', ['open' => 'add']);
    }
    
    public function listQuality(Request $request)
    {
        $q = $request->query('q');
        $length = (int) $request->query('length', 10);
        if ($length <= 0) $length = 10;

        $data = QualityInfo::when($q, function($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%");
            })
            ->latest()
            ->paginate($length);

        $data->appends($request->only(['q','length']));

        return view('Quality.list_quality', compact('data'));
    }

    public function saveQuality(Request $request)
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

                if (!File::exists(public_path('QualityImage'))) {
                    File::makeDirectory(public_path('QualityImage'), 0755, true);
                }

                $targetPath = public_path('QualityImage') . DIRECTORY_SEPARATOR . $orig;
                if (File::exists($targetPath)) {
                    $storedName = time() . '_' . uniqid() . '_' . $orig;
                } else {
                    $storedName = $orig;
                }

                $file->move(public_path('QualityImage'), $storedName);
                $savedNames[] = $storedName;

                if (count($savedNames) >= 5) break;
            }
        }

        QualityInfo::create([
            'title' => $request->title,
            'description' => $request->description ?? '',
            'image' => $savedNames,
        ]);

        return redirect()->route('listQuality')->with('success', 'Quality entry added successfully!');
    }

    public function editQuality($id)
    {
        $row = QualityInfo::findOrFail($id);

        return response()->json([
            'id' => $row->id,
            'title' => $row->title,
            'description' => $row->description,
            'image' => is_array($row->image) ? $row->image : ($row->image ? (array) $row->image : []),
        ]);
    }

    public function updateQuality(Request $request, $id)
    {
        $row = QualityInfo::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'string',
        ]);

        $images = is_array($row->image) ? $row->image : [];

        $toRemove = $request->input('remove_images', []);
        if (!empty($toRemove) && is_array($toRemove)) {
            foreach ($toRemove as $remName) {
                $key = array_search($remName, $images, true);
                if ($key !== false) {
                    $full = public_path('QualityImage') . DIRECTORY_SEPARATOR . $remName;
                    if (File::exists($full)) {
                        @unlink($full);
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

                if (!File::exists(public_path('QualityImage'))) {
                    File::makeDirectory(public_path('QualityImage'), 0755, true);
                }

                $targetPath = public_path('QualityImage') . DIRECTORY_SEPARATOR . $orig;
                if (File::exists($targetPath)) {
                    $storedName = time() . '_' . uniqid() . '_' . $orig;
                } else {
                    $storedName = $orig;
                }

                $file->move(public_path('QualityImage'), $storedName);
                $images[] = $storedName;
            }
        }

        $row->update([
            'title' => $request->title,
            'description' => $request->description ?? '',
            'image' => $images,
        ]);

        return redirect()->route('listQuality')->with('success', 'Quality updated successfully!');
    }

    public function deleteQuality($id)
    {
        $row = QualityInfo::findOrFail($id);

        if (!empty($row->image) && is_array($row->image)) {
            foreach ($row->image as $img) {
                $path = public_path('QualityImage') . DIRECTORY_SEPARATOR . $img;
                if (File::exists($path)) {
                    @unlink($path);
                }
            }
        }

        $row->delete();

        return redirect()->route('listQuality')->with('success', 'Quality entry deleted.');
    }
}
