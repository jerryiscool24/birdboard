<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Concerns\ValidatesAttributes;

class ProjectsController extends Controller
{
    /**
     * Display all projects
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));

    }

    /**
     * Show single project
     *
     * @param  Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }

    /**
     * Display create project form
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     *
     * @param Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Store new project
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function store()
    {
        $project = auth()->user()->projects()->create($this->validateRequest());

        return redirect($project->path());
    }

    /**
     *
     * @param Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Routing\Redirector
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
