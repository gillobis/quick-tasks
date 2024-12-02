<?php

namespace App\Livewire\Task;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateTasksList extends Component
{
    #[Validate('required')]
    public $title;

    public function createTasksList()
    {
        $this->validate();

        /** @var App\Models\User $user  */
        $user = Auth::user();

        $taskList = $user->taskLists()->create([
            'title' => $this->title,
        ]);

        $this->redirect('/app/'.$taskList->slug, navigate: true);
    }

    public function render()
    {
        return view('livewire.task.create-tasks-list');
    }
}
