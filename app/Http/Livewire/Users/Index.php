<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\User;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.users.index', [
            'users' => User::latest()->paginate(10)
        ])->extends('admin.template.admin')->section('content');
    }
}
