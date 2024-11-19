<?php

namespace App\Livewire\Task;

use App\Models\Task;
use App\Services\TaskService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class TasksList extends Component
{
    public $tasks;

    public $taskList;

    public $showTaskListButtons = false;

    public $title = 'dashboard';

    public $listName;

    public function mount($list = 'upcoming')
    {

        $taskService = new TaskService;
        $this->tasks = $taskService->getUserTasks($list);

        $this->taskList = Auth::user()->taskLists()->whereSlug($list)->first();
        if ($this->taskList && Auth::user()->taskLists()->count() > 1) {
            $this->showTaskListButtons = true;
        }
        $this->title = $this->taskList ? $this->taskList->title : ucfirst($list);

        $this->listName = $list;

    }

    #[On('task-created')]
    public function updateTaskList()
    {
        $taskService = new TaskService;
        $this->tasks = $taskService->getUserTasks($this->listName);
    }

    public function updataTaskListName()
    {
        if ($this->taskList) {
            $this->taskList->update(['title' => $this->title]);
            $this->listName = $this->taskList->slug;
        }

    }

    public function deleteTask(Task $task)
    {
        $task->delete();

        $this->updateTaskList();

        $this->dispatch('notify', message: 'Task deleted');
    }

    public function deleteCompletedTasks(TaskService $taskService)
    {
        $taskService->deleteCompletedTasks($this->listName);

        $this->updateTaskList();

        $this->dispatch('notify', message: 'Tasks deleted');
    }

    public function markAsDone(Task $task)
    {
        $task->done_at = Carbon::now();
        $task->score = 0;
        $task->save();

        $taskSrv = new TaskService;
        $taskSrv->updateScore($task);

        $this->updateTaskList();
    }

    public function markAsUndone(Task $task)
    {
        $task->done_at = null;
        $task->save();

        $taskSrv = new TaskService;
        $taskSrv->updateScore($task);

        $this->updateTaskList();
    }

    public function deleteList()
    {
        $this->dispatch('delete-list', taskListId: $this->taskList->id);
        $this->dispatch('notify', message : 'Tasks list deleted');
    }

    public function render()
    {
        return view('livewire.task.tasks-list');
    }
}
