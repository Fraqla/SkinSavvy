<?php

namespace App\Livewire\ManageUser;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class ManageUsers extends Component
{
    use WithPagination;
    
    public $selectedRole = 'all';
    public $roles = [];
    public $search = '';

    public function mount()
    {
        $this->roles = Role::pluck('name')->toArray();
        array_unshift($this->roles, 'all');
    }

    public function updatingSelectedRole()
    {
        $this->resetPage();
    }

    public function searchByRole()
    {
        $this->resetPage(); // Reset pagination when search is triggered
    }

    public function render()
    {
        $users = User::query()
            ->when($this->selectedRole !== 'all', function($query) {
                $query->whereHas('roles', function($q) {
                    $q->where('name', $this->selectedRole);
                });
            })
            ->with('roles')
            ->select('users.id', 'users.name', 'users.email')
            ->paginate(10);

        // Add role_name to each user
        $users->getCollection()->transform(function($user) {
            $user->role_name = $user->roles->first()?->name ?? 'No Role';
            return $user;
        });

        return view('livewire.manage-user.user-list', [
            'users' => $users,
            'roles' => $this->roles
        ]);
    }
}
