<?php

namespace App\Http\Controllers;

use App\Models\SliderInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SliderController extends Controller
{
    public function addSlider()
    {
         return redirect()->route('listSlider', ['open' => 'add']);
    }

    public function saveSlider(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $imageName = null;
            if ($request->hasFile('slider_image')) {
                $image = $request->file('slider_image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('SliderImage'), $imageName);
            } else {
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => 'Image upload failed.'], 422);
                }
                return back()->with('error', 'Image upload failed.');
            }

            $slider = SliderInfo::create([
                'title' => $request->title,
                'slider_image' => $imageName,
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Slider added successfully.',
                    'data' => $slider
                ]);
            }

            return redirect()->route('listSlider')->with('success', 'Slider added successfully.');
        } catch (\Throwable $e) {
            Log::error('Save slider error: ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Server error. Try again.'], 500);
            }
            return back()->with('error', 'Server error. Try again.');
        }
    }


    public function listSlider(Request $request)
    {
        $perPage = (int) $request->get('length', 10);
        $query = SliderInfo::query();

        if ($q = $request->get('q')) {
            $query->where('title', 'like', '%' . $q . '%');
        }

        $slider_data = $query->orderBy('id', 'desc')->paginate($perPage)->withQueryString();
        return view('Slider.list_slider', compact('slider_data'));
    }


    public function editSlider($id)
    {
        $slider = SliderInfo::findOrFail($id);
        return response()->json($slider);
    }

    public function updateSlider(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'slider_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $slider = SliderInfo::findOrFail($id);
            $slider->title = $validated['title'];

            if ($request->hasFile('slider_image')) {
                // delete old file
                if ($slider->slider_image && File::exists(public_path('SliderImage/' . $slider->slider_image))) {
                    File::delete(public_path('SliderImage/' . $slider->slider_image));
                }

                $image = $request->file('slider_image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('SliderImage'), $imageName);
                $slider->slider_image = $imageName;
            }

            $slider->save();

            return response()->json([
                'success' => true,
                'message' => 'Slider updated successfully.',
                'data' => $slider,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            Log::error('Slider update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error. Try again.',
            ], 500);
        }
    }

    public function deleteSlider($id)
    {
        try {
            $slider = SliderInfo::findOrFail($id);

            if ($slider->slider_image && File::exists(public_path('SliderImage/' . $slider->slider_image))) {
                File::delete(public_path('SliderImage/' . $slider->slider_image));
            }

            $slider->delete();
            return redirect()->route('listSlider')->with('success', 'Slider deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Slider delete error: ' . $e->getMessage());
            return redirect()->route('listSlider')->with('error', 'Server error. Try again.');
        }
    }
}
