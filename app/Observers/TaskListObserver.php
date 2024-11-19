<?php

namespace App\Observers;

use App\Models\TaskList;
use Illuminate\Support\Str;

class TaskListObserver
{
    /**
     * Handle the TaskList "created" event.
     */
    public function creating(TaskList $taskList): void
    {
        $taskList->slug = Str::of($taskList->title)->slug();
    }

    /**
     * Handle the TaskList "updated" event.
     */
    public function updating(TaskList $taskList): void
    {
        $taskList->slug = Str::of($taskList->title)->slug();
    }

    /**
     * Handle the TaskList "deleted" event.
     */
    public function deleted(TaskList $taskList): void
    {
        //
    }

    /**
     * Handle the TaskList "restored" event.
     */
    public function restored(TaskList $taskList): void
    {
        //
    }

    /**
     * Handle the TaskList "force deleted" event.
     */
    public function forceDeleted(TaskList $taskList): void
    {
        //
    }
}
