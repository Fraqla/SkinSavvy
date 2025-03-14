<?php

namespace App\Livewire\ManageUser;

use Livewire\Component;
use App\Models\User;

class AdminConsultantApproval extends Component
{
    public function render()
    {
        $pendingUsers = User::where('role', 'admin_consultant')->where('status', 'pending')->get();
        return view('livewire.manage-user.admin-consultant-approval', compact('pendingUsers'));
    }

    public function approve($userId)
    {
        User::where('id', $userId)->update(['status' => 'active']);
        session()->flash('message', 'Admin Consultant approved!');
    }

    public function reject($userId)
    {
        User::where('id', $userId)->update(['status' => 'rejected']);
        session()->flash('message', 'Admin Consultant rejected!');
    }
}
