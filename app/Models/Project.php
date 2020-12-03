<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $old = [];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Record activity for a project
     *
     * @param object $project
     * @param string $description
     * @return void
     */
    public function recordActivity($type)
    {
        $this->activity()->create([
            'description' => $type,
            'changes' => $this->activityChanges($type)
        ]);
    }

    protected function activityChanges($type)
    {
        if($type === 'updated') {
            return [
                'before' => Arr::except(array_diff($this->old, $this->getAttributes()), ['updated_at', 'created_at']),
                'after' => Arr::except($this->getChanges(), ['updated_at', 'created_at'])
            ];
        }
    }


    /**
     * The activity feed for the project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }
}
