<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectTaskController
{
    public function store(Request $request, Project $project)
    {
        if ($project->owner->id != auth()->user()->id) {
            abort(403);
        }

        $request->validate(['body' => 'required']);

        $project->add_task($request->get('body'));

        return redirect()->back();
    }

    public function update(Request $request, Project $project, Task $task)
    {
        if ($project->owner->id != auth()->user()->id) {
            abort(403);
        }

        $task->update([
            'body' => $request->body,
            'completed' => $request->has('completed')
        ]);
        return back();
    }
}
