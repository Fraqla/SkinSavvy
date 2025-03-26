<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Product;

class Dashboard extends Component
{
    public $totalUsers;
    public $totalProducts;
    public $pendingUsers;

    public function mount()
    {
        $this->totalUsers = User::count();
        $this->totalProducts = Product::count();
        $this->pendingUsers = User::where('status', 'pending')->count();
    }

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