<?php

namespace App\Livewire\ManageUser;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class ManageUsers extends Component
{
    public $selectedRole = 'all';
    public $roles = [];

    public function mount()
    {
        // Fetch roles from the roles table, prepend 'all'
        $this->roles = Role::pluck('name')->prepend('all')->toArray();
    }

    public function updatedSelectedRole()
    {
        // Ensure the component re-renders on role change
        $this->render();
    }

    public function render()
    {
        // Build the user query with role filter
        $query = User::select('users.id', 'users.name', 'users.email', 'roles.name as role_name')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id');

        if ($this->selectedRole !== 'all') {
            $query->where('roles.name', $this->selectedRole);
        }

        $users = $query->get();

        return view('livewire.manage-user.user-list', ['users' => $users]);
    }
}
