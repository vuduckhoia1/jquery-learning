<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $skill_new = new Skill;
        $skill_new->name= $request->name;
        $skill_new->user_id = 3;

        $skill_new->save();
        return response()->json($skill_new);
    }
}
