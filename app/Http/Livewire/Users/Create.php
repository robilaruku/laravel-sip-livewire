<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

class Create extends Component
{
    public $name, $email, $password;

    public function render()
    {
        return view('livewire.users.create');
    }
}
