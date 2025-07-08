<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class SignUp extends Component
{
    use WithFileUploads;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role;
    public $certificate;


    // Validation rules
    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'certificate' => 'required|file|mimes:pdf|max:2048',
    ];

    public function register()
{
    $this->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'certificate' => 'required|file|mimes:pdf|max:2048',
    ]);

      // Store certificate file if uploaded
        $certificatePath = null;
        if ($this->certificate) {
            $certificatePath = $this->certificate->store('certificates', 'public');
        }


    $user = User::create([
        'name' => $this->name,
        'email' => $this->email,
        'password' => bcrypt($this->password),
        'status' => 'pending', 
        'certificate' => $certificatePath,
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
