<?php

namespace App\Http\Livewire\Roles;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.roles.index')
        ->extends('admin.template.admin')->section('content');
    }
}
