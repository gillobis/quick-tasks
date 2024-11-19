<?php

namespace App\Livewire\Task;

use Livewire\Component;

class Task extends Component
{
    public $task;

    public function delete()
    {
        $this->task->delete();
        $this->task = null;

        $this->dispatch('task-deleted');
    }

    public function render()
    {
        return view('livewire.task.task');
    }
}
