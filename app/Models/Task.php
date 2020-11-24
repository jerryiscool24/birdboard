<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $touches = ['project'];

    protected $casts = [
        'completed' => 'boolean'
    ];

    /**
     * Mark task complete
     *
     */
    public function complete()
    {
        $this->update(['completed' => true]);

        $this->project->recordActivity('completed_task');
    }

    /**
     * Marked task as incomplete
     *
     */
    public function incomplete()
    {
        $this->update(['completed' => false]);

        $this->project->recordActivity('incompleted_task');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "{$this->project->path()}/tasks/{$this->id}";
    }

}
