<?php

namespace App\Livewire\Task;

use App\Models\TaskList;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddForm extends Component
{
    #[Validate('required')]
    public $title;

    public $priority = 1;

    public ?TaskList $taskList;

    //public $taskListId;
    public $dueDate;

    /* protected $listeners = [
      'task-created' => '$refresh'
    ]; */

    public function mount($list = null)
    {
        $taskList = Auth::user()->taskLists()->whereSlug($list)->first();

        if (! $taskList) {
            $taskList = Auth::user()->taskLists()->orderBy('created_at', 'asc')->first();
        }

        $this->taskList = $taskList;
    }

    public function setTaskList($taskListId)
    {
        $this->taskList = Auth::user()->taskLists()->findOrFail($taskListId);
    }

    public function save()
    {
        $this->validate();

        Auth::user()->tasks()->create([
            'title' => $this->title,
            'level' => $this->priority,
            'task_list_id' => $this->taskList->id,
            'due_date' => $this->dueDate,
        ]);

        $this->dispatch('task-created');
        $this->dispatch('notify', message : 'Task successfully created');

        $this->reset('title', 'priority', 'dueDate');
    }

    public function render()
    {
        return view('livewire.task.add-form');
    }
}
