<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * index
     *
     * @return view
     */
    public function index()
    {
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));

    }

    /**
     * show
     *
     * @param  Illuminate\Database\Eloquent\Model
     * @return view
     */
    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }

    /**
     * create
     *
     * @return view
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * store
     *
     * @return view
     */
    public function store()
    {
        $attributes = request()->validate([
            'title' => ['required'],
            'description' => ['required', 'max:100'],
            'notes' => ['max:255']
        ]);

        $project = auth()->user()->projects()->create($attributes);

        return redirect($project->path());
    }

    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $project->update(request(['notes']));

        return redirect($project->path());
    }
}
