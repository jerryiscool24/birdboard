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
        if(auth()->user()->isNot($project->owner)) {
            abort(403);
        }

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
            'description' => ['required']
        ]);

        $project = auth()->user()->projects()->create($attributes);

        return redirect($project->path());
    }
}
