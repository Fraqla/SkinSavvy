<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function index()
{
    if (auth()->user()->status === 'pending') {
        return redirect()->route('waiting-approval')->with('message', 'Your account is awaiting approval.');
    }

    return view('dashboard');
}

    public function render()
    {
        return view('livewire.dashboard');
    }
}
