<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Http\RedirectResponse;

class Logout extends Component
{
    public function logout()
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect()->route('signin'); // Redirect to login page
    }

    public function render()
    {
        return view('livewire.logout');
    }
}
