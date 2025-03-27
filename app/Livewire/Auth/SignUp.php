<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SignUp extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role;

    // Validation rules
    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
    ];

    public function register()
{
    $this->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $this->name,
        'email' => $this->email,
        'password' => bcrypt($this->password),
        'status' => 'pending', // Set status to pending
    ]);

    // Properly assign the role using Laravel Permissions package
    $user->assignRole('admin_consultant');

    session()->flash('success', 'Account created successfully! Please wait for admin approval.');

    return redirect()->route('sign-in');
}
    
    
    

    public function render()
    {
        return view('livewire.auth.sign-up');
    }
}
