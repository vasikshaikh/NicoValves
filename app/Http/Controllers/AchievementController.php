<?php

namespace App\Http\Controllers;

use App\Models\AchievementInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AchievementController extends Controller
{
    // Show Add Achievement Form (if needed)
    public function addAchievement()
    {
        return redirect()->route('listAchievement', ['open' => 'add']);
    }


    public function saveAchievement(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'count' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $achievement = new AchievementInfo();
        $achievement->title = $request->title;
        $achievement->count = $request->count ?? 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('AchievementImage'), $imageName);
            $achievement->image = $imageName;
        }

        $achievement->save();

        return redirect()->route('listAchievement')->with('success', 'Achievement added successfully.');
    }

    public function listAchievement(Request $request)
    {
        $query = AchievementInfo::query();

        if ($request->q) {
            $query->where('title', 'like', '%'.$request->q.'%');
        }

        $length = $request->length ?? 10;
        $achievements = $query->orderBy('id', 'desc')->paginate($length)->withQueryString();

        return view('Achievement.list_achievement', compact('achievements'));
    }

    public function editAchievement($id)
    {
        $achievement = AchievementInfo::findOrFail($id);

        return response()->json([
            'title' => $achievement->title,
            'count' => $achievement->count,
            'image' => $achievement->image,
        ]);
    }

    public function updateAchievement(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'count' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $achievement = AchievementInfo::findOrFail($id);
        $achievement->title = $request->title;
        $achievement->count = $request->count ?? 0;

        if ($request->hasFile('image')) {

            if ($achievement->image && File::exists(public_path('AchievementImage/'.$achievement->image))) {
                File::delete(public_path('AchievementImage/'.$achievement->image));
            }

            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('AchievementImage'), $imageName);
            $achievement->image = $imageName;
        }

        $achievement->save();

        return redirect()->route('listAchievement')->with('success', 'Achievement updated successfully.');
    }

    public function deleteAchievement($id)
    {
        $achievement = AchievementInfo::findOrFail($id);

        if ($achievement->image && File::exists(public_path('AchievementImage/'.$achievement->image))) {
            File::delete(public_path('AchievementImage/'.$achievement->image));
        }

        $achievement->delete();

        return redirect()->route('listAchievement')->with('success', 'Achievement deleted successfully.');
    }
}
