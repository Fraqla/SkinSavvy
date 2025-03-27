<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WaitingApproval extends Component
{
    public function mount()
    {
        // Redirect if user is not pending
        if (Auth::user()->status !== 'pending') {
            return redirect()->route('dashboard');
        }
    }

    public function render()
    {
        return view('livewire.manage-user.waiting-approval');
    }
}