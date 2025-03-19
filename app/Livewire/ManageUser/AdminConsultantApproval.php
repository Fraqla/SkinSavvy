<?php

namespace App\Livewire\ManageUser;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;

class AdminConsultantApproval extends Component
{
    public $pendingAdmins;

    public function mount()
    {
        $this->loadPendingAdmins();
    }

    public function loadPendingAdmins()
    {
        $adminConsultantRole = Role::where('name', 'admin_consultant')->first();

        if ($adminConsultantRole) {
            $this->pendingAdmins = User::whereHas('roles', function ($query) use ($adminConsultantRole) {
                $query->where('role_id', $adminConsultantRole->id);
            })->where('status', 'pending')->get();
        }
    }

    public function approve($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->update(['status' => 'active']);
            session()->flash('success', 'Admin consultant approved successfully!');
        }
        $this->loadPendingAdmins(); // Refresh list
    }

    public function remove($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            session()->flash('error', 'Admin consultant account removed.');
        }
        $this->loadPendingAdmins();
    }

    public function render()
    {
        return view('livewire.manage-user.admin-consultant-approval');
    }
}
