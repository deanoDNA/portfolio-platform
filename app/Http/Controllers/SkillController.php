<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Auth::user()->skills;
        return view('skills.index', compact('skills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'level' => 'required|in:Beginner,Intermediate,Advanced',
        ]);

        Auth::user()->skills()->create($request->only('name', 'level'));

        return back();
    }

    public function destroy(Skill $skill)
    {
        abort_if($skill->user_id !== Auth::id(), 403);
        $skill->delete();

        return back();
    }
}
