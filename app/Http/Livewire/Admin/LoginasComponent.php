<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginasComponent extends Component
{
    public $notfound = 0;
    public $userid = 0;

    public function render()
    {
        return view('livewire.admin.loginas.loginas-component',
        [
            'found' => $this->found,
            'notfound' => $this->notfound,
            'users' => $this->users(),
        ]);
    }

    public function logInAs()
    {
        if(! $this->userid){

            $this->notfound = 1;

        }else{

            Auth::loginUsingId($this->userid);

            return redirect()->to('dashboard');
        }
    }

    private function users() : Collection
    {
        $users = User::all();

        return $users->sortBy('last');
    }
}
