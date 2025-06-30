<?php

namespace App\Livewire\ManageRole;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ManageRoles extends Component
{
    public $roles;
    public $currentRole;
    public $permissions = [];
    public $allPermissions;
    public $editing = false;

    public function mount()
    {
        $this->roles = Role::all();
        $this->allPermissions = Permission::all();
    }

    public function editPermissions($roleId)
    {
        $this->currentRole = Role::find($roleId);
        $this->permissions = $this->currentRole->permissions->pluck('name')->toArray();
        $this->editing = true;
    }

    public function updatePermissions()
    {
        $this->currentRole->syncPermissions($this->permissions);
        session()->flash('message', 'Permissions updated successfully.'); 
        $this->editing = false;
        $this->mount();  // Refresh the role list
    }


    public function cancelEdit()
    {
        $this->editing = false;
    }

    public function render()
    {
        return view('livewire.manage-role.manage-roles');
    }
}
