<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SettingsPage extends Component
{
    public string $email;

    public $notifyEmail;

    public function mount()
    {
        $this->email = Auth::user()->email;
        $this->notifyEmail = Auth::user()->notify_email;
    }

    public function save()
    {

        $this->validate([
            'email' => 'required|email',
        ]);

        Auth::user()->update([
            'email' => $this->email,
            'notify_email' => $this->notifyEmail ?: 0,
        ]);

        //flash message
        session()->flash('message', 'User successfully updated');
    }

    public function deleteUser()
    {
        Auth::user()->delete();

        $this->redirect('login');
    }

    public function render()
    {
        return view('livewire.settings-page')->extends('layouts.app');
    }
}
