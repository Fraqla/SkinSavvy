<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Session;

class SignIn extends Component
{
    public $email, $password;
    protected $auth;

    public function __construct()
    {
        $this->auth = (new Factory)
            ->withServiceAccount(config('firebase.credentials'))
            ->createAuth();
    }

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        try {
            $signInResult = $this->auth->signInWithEmailAndPassword($this->email, $this->password);

            // Store Firebase user ID in session
            Session::put('uid', $signInResult->firebaseUserId());

            return redirect()->route('dashboard'); // Redirect to dashboard

        } catch (\Exception $e) {
            session()->flash('error', 'Invalid credentials.');
        }
    }

    public function render()
    {
        return view('livewire.auth.sign-in')->layout('layouts.auth');
    }
}
