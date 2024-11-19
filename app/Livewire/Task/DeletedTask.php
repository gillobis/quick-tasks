<?php

namespace App\Livewire\Task;

use App\Models\Task as TaskModel;
use Livewire\Component;

class DeletedTask extends Component
{
    public $task;

    public function mount($task)
    {
        $this->task = $task;

    }

    public function delete()
    {

        TaskModel::withTrashed()->find($this->task['id'])->forceDelete();

        redirect('app/deleted');

    }

    public function restore()
    {
        $this->task->restore();

        $this->dispatch('task-created');
    }

    public function render()
    {
        return view('livewire.task.deleted-task');
    }
}
