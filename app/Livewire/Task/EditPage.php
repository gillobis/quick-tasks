<?php

namespace App\Livewire\Task;

use App\Models\Task;
use App\Models\TaskList;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditPage extends Component
{
    public Task $task;

    public string $title;

    public $priority = 1;

    public ?TaskList $taskList;

    //public $taskListId;
    public $dueDate;

    public function mount(Task $task)
    {
        $this->title = $task->title;
        $this->taskList = $task->taskList;
        $this->priority = $task->level;
        $this->dueDate = $task->due_date;
    }

    public function setTaskList($taskListId)
    {
        $this->taskList = Auth::user()->taskLists()->findOrFail($taskListId);
    }

    public function save()
    {
        $this->validate(['title' => 'required']);

        $this->task->update([
            'title' => $this->title,
            'level' => $this->priority,
            'task_list_id' => $this->taskList->id,
            'due_date' => $this->dueDate,
        ]);

        $taskSrv = new TaskService;
        $taskSrv->updateScore($this->task);

        $this->dispatch('task-updated');

        $this->redirect('/app/'.$this->taskList->slug, navigate: true);
    }

    public function render()
    {
        return view('livewire.task.edit-page')->extends('layouts.app');
    }
}
