<?php

namespace App\Http\Controllers;

use App\Models\AboutInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    public function addAbout()
    {
         return redirect()->route('listAbout', ['open' => 'add']);
    }

       public function saveAbout(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $about = new AboutInfo();
        $about->title = $request->title;
        $about->description = $request->description;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'_'.Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('AboutImage'), $imageName);
            $about->image = $imageName;
        }

        $about->save();

        return redirect()->route('listAbout')->with('success', 'About infomation added successfully.');
    }

    public function listAbout(Request $request)
    {
        $query = AboutInfo::query();

        if($request->q){
            $query->where('title', 'like', '%'.$request->q.'%');
        }

        $length = $request->length ?? 10;
        $about_data = $query->orderBy('id', 'desc')->paginate($length)->withQueryString();

        return view('About.list_about', compact('about_data'));
    }

    public function editAbout($id)
    {
        $about = AboutInfo::findOrFail($id);

        return response()->json([
            'id' => $about->id,
            'title' => $about->title,
            'description' => $about->description,
            'image' => $about->image,
        ]);
    }

   public function updateAbout(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $about = AboutInfo::findOrFail($id);
    $about->title = $request->title;
    $about->description = $request->description;

    if($request->hasFile('image')){
        // Delete old image if exists
        if($about->image && file_exists(public_path('AboutImage/'.$about->image))){
            unlink(public_path('AboutImage/'.$about->image));
        }

        $image = $request->file('image');
        $imageName = time().'_'.Str::slug($request->title).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('AboutImage'), $imageName);
        $about->image = $imageName;
    }

    $about->save();

    return redirect()->route('listAbout')->with('success', 'About infomation updated successfully.');
}


    public function deleteAbout($id)
    {
        $about = AboutInfo::findOrFail($id);

        if($about->image && File::exists(public_path('AboutImage/'.$about->image))){
            File::delete(public_path('AboutImage/'.$about->image));
        }

        $about->delete();

        return redirect()->route('listAbout')->with('success', 'About infomation deleted successfully.');
    }
}
