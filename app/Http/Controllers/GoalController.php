<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoalInfo;
use Illuminate\Support\Str;

class GoalController extends Controller
{
    // Show add form
    public function addGoal()
    {
         return redirect()->route('listGoal', ['open' => 'add']);
    }

    // Save new goal
    public function saveGoal(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $goal = new GoalInfo();
        $goal->title = $request->title;
        $goal->description = $request->description;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'_'.Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('GoalImage'), $imageName);
            $goal->image = $imageName;
        }

        $goal->save();

        return redirect()->route('listGoal')->with('success', 'Goal added successfully.');
    }

    // List all goals with pagination
    public function listGoal(Request $request)
    {
        $query = GoalInfo::query();

        if($request->q){
            $query->where('title', 'like', '%'.$request->q.'%');
        }

        $length = $request->length ?? 10;
        $goal_data = $query->orderBy('id', 'desc')->paginate($length)->withQueryString();

        return view('Goal.list_goal', compact('goal_data'));
    }

    // Fetch goal data for edit
    public function editGoal($id)
    {
        $goal = GoalInfo::findOrFail($id);
        return response()->json($goal);
    }

    // Update goal
    public function updateGoal(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $goal = GoalInfo::findOrFail($id);
        $goal->title = $request->title;
        $goal->description = $request->description;

        if($request->hasFile('image')){
            // Optional: delete old image
            if($goal->image && file_exists(public_path('GoalImage/'.$goal->image))){
                unlink(public_path('GoalImage/'.$goal->image));
            }

            $image = $request->file('image');
            $imageName = time().'_'.Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('GoalImage'), $imageName);
            $goal->image = $imageName;
        }

        $goal->save();

        return redirect()->route('listGoal')->with('success', 'Goal updated successfully.');
    }

    // Delete goal
    public function deleteGoal($id)
    {
        $goal = GoalInfo::findOrFail($id);

        if($goal->image && file_exists(public_path('GoalImage/'.$goal->image))){
            unlink(public_path('GoalImage/'.$goal->image));
        }

        $goal->delete();

        return redirect()->route('listGoal')->with('success', 'Goal deleted successfully.');
    }
}
