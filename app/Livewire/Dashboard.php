<?php

namespace App\Livewire;

use App\Models\TaskList;
use Livewire\Attributes\On;
use Livewire\Component;

class Dashboard extends Component
{
    /** @var string */
    public $title = 'dashboard';

    public $listName;

    public function mount($list = 'upcoming')
    {
        $this->listName = $list;
    }

    #[On('delete-list')]
    public function deleteList($taskListId)
    {
        
        $taskList = TaskList::find($taskListId);

        $taskList->tasks()->forceDelete();
        $taskList->delete();

        return $this->redirect('/app', navigate: true);
    }

    public function render()
    {
        return view('livewire.dashboard')->extends('layouts.app');
    }
}
