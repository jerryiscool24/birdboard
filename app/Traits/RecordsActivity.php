<?php

namespace App\Traits;

use App\Models\Activity;
use Illuminate\Support\Arr;

trait RecordsActivity
{
    public $oldAttributes = [];

    /**
     * Boot trait
     *
     */
    public static function bootRecordsActivity()
    {
        foreach (self::recordableEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($model->activityDescription($event));
            });

            if ($event === 'updated') {
                static::updating(function ($model) {
                    $model->oldAttributes =  $model->getOriginal();
                });
            }
        }
    }

    /**
     * Record activity for a project
     *
     * @param string $description
     */
    protected function activityDescription($description)
    {
        return "{$description}_" . strtolower(class_basename($this));
    }

    /**
     * Fetch the model events that should trigger activity
     *
     * @return array
     */
    protected static function recordableEvents()
    {
        if (isset(static::$recordableEvents)) {
            return static::$recordableEvents;
        }
        return ['created', 'updated', 'deleted'];
    }


    /**
     * Record activity
     *
     * @param string $description
     * @return void
     */
    public function recordActivity($description)
    {
        $this->activity()->create([
            'description' => $description,
            'changes' => $this->activityChanges(),
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id
        ]);
    }

    /**
     * The activity feed for the project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }

    /**
     * Fetch the changes to the model
     *
     * @return array|null
     */
    protected function activityChanges()
    {
        if ($this->wasChanged()) {
            return [
                'before' => Arr::except(array_diff($this->oldAttributes, $this->getAttributes()), ['updated_at', 'created_at']),
                'after' => Arr::except($this->getChanges(), ['updated_at', 'created_at'])
            ];
        }
    }
}