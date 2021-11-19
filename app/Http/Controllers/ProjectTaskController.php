<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectTaskController
{
    public function store(Request $request, Project $project)
    {
        $request->validate(['body' => 'required']);

        $project->add_task($request->get('body'));

        return redirect()->back();
    }
}
