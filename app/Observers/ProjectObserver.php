<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Project;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
        $this->recordActivity($project, 'created');
    }

    /**
     * Handle the Project "updated" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        $this->recordActivity($project, 'updated');
    }

    /**
     * Record activity
     *
     * @param object $project
     * @param string $type
     * @return void
     */
    protected function recordActivity($project, $type)
    {
        Activity::create([
            'project_id' => $project->id,
            'description' => $type
        ]);
    }

}
