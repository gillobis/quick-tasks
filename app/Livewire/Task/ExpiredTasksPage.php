<?php

namespace App\Livewire\Task;

use Livewire\Component;

class ExpiredTasksPage extends Component
{
    public function render()
    {
        return view('livewire.task.expired-tasks-page')->extends('layouts.app');
    }
}
