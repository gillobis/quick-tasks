<?php

namespace App\Livewire;

use App\Services\TaskService;
use Livewire\Attributes\On;
use Livewire\Component;

class DeletedTasks extends Component
{
    public $tasks;

    public function mount()
    {

        $taskService = new TaskService;
        $this->tasks = $taskService->getUserTasks('deleted');
    }

    #[On('task-deleted', 'task-created')]
    public function updateTaskList()
    {
        $taskService = new TaskService;
        $this->tasks = $taskService->getUserTasks('deleted');
    }

    public function render()
    {
        return view('livewire.deleted-tasks')->extends('layouts.app');
    }
}
