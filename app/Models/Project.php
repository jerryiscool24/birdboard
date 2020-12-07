<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Project extends Model
{
    use HasFactory, RecordsActivity;

    protected $guarded = [];

    /**
     * Serialize date
     *
     * @param DateTimeInterface $date
     * @return date
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * Path for a single project
     *
     * @return string
     */
    public function path()
    {
        return "/projects/{$this->id}";
    }

    /**
     * Get the owner of the project
     *
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
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

    /**
     * Get the tasks for a project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
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

    public function invite(User $user)
    {
        $this->members()->attach($user);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, "project_members");
    }
}
