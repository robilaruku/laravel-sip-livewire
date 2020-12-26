<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class Edit extends Component
{
    public $permissions, $name;
    public $checkbox_attribute = 'id';
    public $checkbox_all = false;
    public $checkbox_values = [];
    public $rolePermissions;
    public $checked = [];
    public $roleId;

    protected $rules = [
        'name'               => 'required|unique:roles,name',
        "checkbox_values"    => "required|array|min:1",
        "checkbox_values.*"  => "required|string|distinct|min:1",
    ];

    protected $messages = [
        'name.required'   => 'Name field is required',
        "checkbox_values.required" => "Checkbox Permission is required"
    ];


    public function mount($id)
    {
        $role = Role::findOrFail($id);

        $this->roleId = $role->id;

        $this->name = $role->name;
        
        $this->rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();

        $this->permissions = Permission::get();

        foreach ($this->permissions as $key => $value) {
            if (in_array($value->{$this->checkbox_attribute}, $this->rolePermissions)) {
                $this->checkbox_values[] = (string)$value->{$this->checkbox_attribute};
            }
        }

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

    public function updatedRole()
    {
        $this->validate();

        $role = Role::find($this->roleId);
        $role->name = $this->name;
        $role->save();

        $role->syncPermissions($this->checkbox_values);
    
        session()->flash ('message', 'Role has updated');

        return redirect()->route('roles.index');
    }


    public function render()
    {
        return view('livewire.roles.edit')
        ->extends('admin.template.admin')->section('content');
    }
}
