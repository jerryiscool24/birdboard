<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Concerns\ValidatesAttributes;

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
     *
     * @param Project $project
     * @return view
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * store
     *
     * @return view
     */
    public function store()
    {
        $project = auth()->user()->projects()->create($this->validateRequest());

        return redirect($project->path());
    }

    /**
     *
     * @param Project $project
     * @return redirect
     */
    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $project->update($this->validateRequest());

        return redirect($project->path());
    }

    /**
     * validate request attributes
     *
     * @return array
     */
    protected function validateRequest()
    {
        return request()->validate([
            'title' => ['sometimes', 'required'],
            'description' => ['sometimes', 'required', 'max:100'],
            'notes' => ['nullable']
        ]);
    }
}
