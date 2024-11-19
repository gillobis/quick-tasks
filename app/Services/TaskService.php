<?php

namespace App\Services;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function getUserTasks(string $list = 'upcoming')
    {
        $tasks = null;

        if ($list == 'upcoming') { // upcoming
            $tasks = Auth::user()->tasks()->with('taskList')->valid()->orderBy('score', 'desc')->orderBy('created_at', 'asc')->limit(10)->get();
        } elseif ($list == 'today') {
            $tasks = Auth::user()->tasks()->with('taskList')->whereNull('done_at')->whereDate('due_date', Carbon::today())->orderBy('created_at', 'asc')->get();
        } elseif ($list == 'deleted') {
            $tasks = Auth::user()->tasks()->with('taskList')->onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        } elseif ($list == 'expired') {
            $tasks = Auth::user()->tasks()->with('taskList')->expired()->orderBy('due_date', 'desc')->get();
        } else {
            $taskList = Auth::user()->taskLists()->whereSlug($list)->firstOrFail();
            $tasks = $taskList->tasks()->with('taskList')->orderBy('done_at', 'desc')->get();
        }

        foreach ($tasks as $task) {
            if ($this->needScoreUpdate($task)) {
                $this->updateScore($task);
            }
        }

        $tasks = $tasks->sortByDesc('score')->all();

        return collect($tasks);
    }

    public function deleteCompletedTasks(string $list = 'upcoming') : void
    {
        $tasks = null;

        
        $taskList = Auth::user()->taskLists()->whereSlug($list)->firstOrFail();
        $tasks = $taskList->tasks()->done()->delete();

        return;
    }

    public function needScoreUpdate($task)
    {
        if ($task->isExpired) {
            return false;
        }

        $now = Carbon::now();

        return $task->updated_at->startOfDay()->diffInDays($now) > 1;
    }

    public function getScore(Task $task)
    {
        if ($task->done_at) {
            return 0;
        }

        $now = Carbon::now();
        $age = ceil($task->created_at->diffInDays($now)/30);
        $timeToEnd = $task->due_date ? max($now->diffInDays($task->due_date), 1) : 30;
        $score = (3 * (pow($task->level, 2) + $age)) / pow($timeToEnd, 2);

        return $score;
    }

    public function updateScore(Task $task)
    {
        $score = $this->getScore($task);

        $task->score = $score;
        $task->save();

        return $score;
    }

    public function needAttention(Task $task)
    {
        if ($task->isExpired || $task->done_at) {
            return false;
        }

        return $task->score > 10;
    }
}
