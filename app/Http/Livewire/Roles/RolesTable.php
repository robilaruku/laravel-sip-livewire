<?php

namespace App\Http\Livewire\Roles;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RolesTable extends TableComponent
{
    use HtmlComponents;
    public $exports = ['csv', 'xls', 'xlsx', 'pdf'];
    
    public $perPage = 10;

    public $roleId;

    protected $options = [
        // The class set on the table when using bootstrap
        'bootstrap.classes.table' => 'table table-striped table-hover table-bordered',
    
        // The class set on the table's thead when using bootstrap
        'bootstrap.classes.thead' => null,
    
        // The class set on the table's export dropdown button
        'bootstrap.classes.buttons.export' => 'btn btn-secondary',
        
        // Whether or not the table is wrapped in a `.container-fluid` or not
        'bootstrap.container' => true,
        
        // Whether or not the table is wrapped in a `.table-responsive` or not
        'bootstrap.responsive' => true
    ];

    public function query() : Builder
    {
        return Role::query();
    }

    public function columns() : array
    {
        return [
            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),
            Column::make('Actions')
                ->format(function(Role $model) {
                    return view('livewire.roles.datatables_actions', ['Role' => $model]);
            })->excludeFromExport(),
        ];
    }

    public function destroy($roleId)
    {
        $role = Role::findOrFail($roleId);

        $role->delete();
   
        //flash message
        session()->flash('message', 'Role deleted successfullly');

        //redirect
        return redirect()->route('roles.index');

    }

}