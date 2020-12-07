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
        $projects = auth()->user()->accessibleProjects();

        return view('projects.index', compact('projects'));

    }

    /**
     * Show single project
     *
     * @param  Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Auth\Access\AuthorizationException
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $project = auth()->user()->projects()->create($this->validateRequest());

        return redirect($project->path());
    }

    /**
     *  Update a project
     *
     * @param Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $project->update($this->validateRequest());

        return redirect($project->path());
    }

    public function destroy(Project $project)
    {
        $this->authorize('update', $project);

        $project->delete();

        return redirect('/projects');
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
