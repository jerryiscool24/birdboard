<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function path()
    {
        return "/projects/{$this->id}";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * Add task to a project
     *
     * @param string $body
     * @return model
     */
    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

     /**
     * Record activity
     *
     * @param object $project
     * @param string $type
     * @return void
     */
    public function recordActivity($type)
    {
        Activity::create([
            'project_id' => $this->id,
            'description' => $type
        ]);
    }
}
