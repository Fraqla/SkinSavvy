<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class WaitingApproval extends Component
{
    public function render()
    {
        return view('livewire.manage-user.waiting-approval');
    }
}