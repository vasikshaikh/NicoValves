<?php

namespace App\Http\Controllers;

use App\Models\ChooseInfo;
use Illuminate\Http\Request;

class ChooseController extends Controller
{
    public function listChoose(Request $request)
    {
        $q = $request->q;
        $length = $request->length ?? 10;

        $choose_data = ChooseInfo::when($q, function($query) use ($q){
            $query->where('title','like',"%$q%")
                  ->orWhere('description','like',"%$q%");
        })->latest()->paginate($length);

        return view('Choose.list_choose', compact('choose_data'));
    }

 public function saveChoose(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string',
        'description' => 'nullable|string',
        'points_title_input' => 'nullable|string', // JSON string from frontend
        'points_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    // Decode JSON string to array
    $pointsTitle = $data['points_title_input'] ? json_decode($data['points_title_input'], true) : [];

    // Handle uploaded images
    $images = [];
    if ($request->hasFile('points_image')) {
        foreach ($request->file('points_image') as $file) {
            // Move file to public/chooseImage folder with original name
            $destinationPath = public_path('chooseImage');
            $file->move($destinationPath, $file->getClientOriginalName());

            // Save original name in DB
            $images[] = $file->getClientOriginalName();
        }
    }

    // Create new ChooseInfo record
    ChooseInfo::create([
        'title' => $data['title'],
        'description' => $data['description'] ?? '',
        'points_title' => $pointsTitle,
        'points_image' => $images,
    ]);

    return redirect()->back()->with('success', 'Choose saved successfully!');
}



    public function editChoose($id)
    {
        $choose = ChooseInfo::findOrFail($id);
        return response()->json([
            'title' => $choose->title,
            'description' => $choose->description,
            'points_title' => $choose->points_title,
            'points_image' => $choose->points_image,
        ]);
    }

 public function updateChoose(Request $request, $id)
{
    $choose = ChooseInfo::findOrFail($id);

    $data = $request->validate([
        'title' => 'required|string',
        'description' => 'nullable|string',
        'points_title_input' => 'nullable|string', // JSON string from frontend
        'points_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    // Decode JSON string to array
    $pointsTitle = $data['points_title_input'] ? json_decode($data['points_title_input'], true) : [];

    // Existing images
    $images = $choose->points_image ?? [];

    // Handle new uploaded images
    if ($request->hasFile('points_image')) {
        foreach ($request->file('points_image') as $file) {
            // Move file to public/chooseImage folder with original name
            $destinationPath = public_path('chooseImage');
            $file->move($destinationPath, $file->getClientOriginalName());

            // Save original name in DB
            $images[] = $file->getClientOriginalName();
        }
    }

    // Update record
    $choose->update([
        'title' => $data['title'],
        'description' => $data['description'] ?? '',
        'points_title' => $pointsTitle,
        'points_image' => $images, // original filenames including new uploads
    ]);

    return redirect()->back()->with('success', 'Choose updated successfully!');
}


    public function deleteChoose($id)
    {
        $choose = ChooseInfo::findOrFail($id);
        $choose->delete();
        return redirect()->back()->with('success','Choose deleted successfully!');
    }
}
