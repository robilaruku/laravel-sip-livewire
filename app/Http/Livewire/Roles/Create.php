<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class Create extends Component
{
    public $permissions, $name;
    public $checkbox_attribute = 'id';
    public $checkbox_all = false;
    public $checkbox_values = [];

    protected $rules = [
        'name'               => 'required|unique:roles,name',
        "checkbox_values"    => "required|array|min:1",
        "checkbox_values.*"  => "required|string|distinct|min:1",
    ];

    protected $messages = [
        'name.required'   => 'Name field is required',
        "checkbox_values.required" => "Checkbox Permission is required"
    ];

    public function mount()
    {
        $this->permissions = Permission::get();
    }

    public function store()
    {
        $this->validate();

        $role = Role::create(['name' => $this->name]);

        $role->syncPermissions($this->checkbox_values);
    
        session()->flash ('message', 'Role has created');

        return redirect()->route('roles.index');
    }

    public function query()
    {
        return Permission::query();
    }

    public function models()
    {
        $models = $this->query();

        return $models;
    }

    public function updatedCheckboxAll()
    {
        $this->checkbox_values = [];

        if ($this->checkbox_all) {
            $this->models()->each(function ($model) {
                $this->checkbox_values[] = (string)$model->{$this->checkbox_attribute};
            });
        }
    }

    public function render()
    {
        return view('livewire.roles.create')
        ->extends('admin.template.admin')->section('content');
    }

}
