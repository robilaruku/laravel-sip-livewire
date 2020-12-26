<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class Show extends Component
{
    public $permissions, $name;
    public $checkbox_attribute = 'id';
    public $checkbox_all = false;
    public $checkbox_values = [];
    public $rolePermissions;
    public $checked = [];
    public $roleId;

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


    public function render()
    {
        return view('livewire.roles.show')
        ->extends('admin.template.admin')->section('content');
    }
}
