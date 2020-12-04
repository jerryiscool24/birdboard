<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    /**
     * Store task to a project
     *
     * @param Illuminate\Database\Eloquent\Model $project
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Project $project)
    {
        $this->authorize('update', $project);

        request()->validate([
            'body' => ['required']
        ]);

        $project->addTask(request('body'));

        return redirect($project->path());
    }

    /**
     * Update the task
     *
     * @param Illuminate\Database\Eloquent\Model $project
     * @param Illuminate\Database\Eloquent\Model $task
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Project $project, Task $task)
    {
        $this->authorize('update', $task->project);

        request()->validate(['body' => ['required']]);

        $task->update(['body' => request('body')]);

        request('completed') ? $task->complete() : $task->incomplete();

        return redirect($project->path());
    }
}
