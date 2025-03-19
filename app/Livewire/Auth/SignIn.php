<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SignIn extends Component
{
    public $email, $password;

    public function login()
    {
        $credentials = ['email' => $this->email, 'password' => $this->password];
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            session()->regenerate();
    
            // Redirect to waiting page if status is pending
            if ( $user->status === 'pending') {
                return redirect()->route('waiting-approval')->with('message', 'Your account is awaiting approval.');
            }
    
            // Redirect to dashboard if approved or other roles
            return redirect()->route('dashboard');
        }
    
        session()->flash('error', 'Invalid login credentials');
    }
    

    public function render()
    {
        return view('livewire.auth.sign-in');
    }

    // Redirect to sign-up page
    public function redirectToSignup()
    {
        return redirect()->route('sign-up');
    }
}
