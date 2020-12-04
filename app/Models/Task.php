<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Task extends Model
{
    use HasFactory, RecordsActivity;

    protected $guarded = [];

    /**
     *
     * @var array
     */
    protected $touches = ['project'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'completed' => 'boolean'
    ];

    /**
     * Overwrite recordable events in trait
     *
     * @var array
     */
    protected static $recordableEvents = ['created', 'deleted'];

    /**
     * Mark task complete
     *
     */
    public function complete()
    {
        $this->update(['completed' => true]);

        $this->recordActivity('completed_task');
    }

    /**
     * Marked task as incomplete
     *
     */
    public function incomplete()
    {
        $this->update(['completed' => false]);

        $this->recordActivity('incompleted_task');
    }

    /**
     * Get the project of a task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Path for single task for a project
     *
     * @return string
     */
    public function path()
    {
        return "{$this->project->path()}/tasks/{$this->id}";
    }
}
