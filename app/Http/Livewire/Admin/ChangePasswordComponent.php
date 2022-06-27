<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePasswordComponent extends Component
{
    public $changed = 0;
    public $changedname = null;
    public $password = '';
    public $user = null;
    public $userid = 0;

    protected $rules = [
        'password' => 'required'
    ];

    public function render()
    {
        return view('livewire.admin.changepassword.change-password-component',
            [
                //'password' => $this->password,
                'users' => $this->users(),
            ]);
    }

    public function changePassword()
    {
        $this->user->update(
            [
                'password' => Hash::make($this->password),
            ]
        );

        $this->changed = $this->password;
        $this->changedname = $this->user->name;

        $this->reset(['password', 'user','userid']);
    }

    public function updatedUserid()
    {
        $this->reset(['changed','changedname']);

        $this->user = User::find($this->userid);

        $this->password = $this->user->email;
    }

    private function users() : Collection
    {
        $users = User::all();

        return $users->sortBy('last');
    }
}
