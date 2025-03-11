<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Exception\Auth\EmailExists;

class SignUp extends Component
{
    public $name, $email, $password, $password_confirmation;
    protected $firebaseService;

    public function __construct()
    {
        $this->firebaseService = new FirebaseService();
    }

    protected $rules = [
        'name' => 'required|string|min:3',
        'email' => 'required|email',
        'password' => 'required|min:6|same:password_confirmation',
    ];

    public function register()
    {
        $this->validate();

        try {
            $userProperties = [
                'email' => $this->email,
                'password' => $this->password,
                'displayName' => $this->name,
            ];

            // Create user in Firebase Authentication
            $createdUser = $this->firebaseService->getAuth()->createUser($userProperties);

            // Store Firebase UID in session
            Session::put('uid', $createdUser->uid);

            // Redirect to login
            return redirect()->route('login')->with('success', 'Registration successful. Please login.');

        } catch (EmailExists $e) {
            session()->flash('error', 'This email is already in use.');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.auth.sign-up')->layout('layouts.auth');
    }
}
