<?php

namespace App\Http\Livewire\Users;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends TableComponent
{
    use HtmlComponents;

    public $exports = ['csv', 'xls', 'xlsx', 'pdf'];
    
    public $perPage = 10;

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
        return User::query();
    }

    public function columns() : array
    {
        return [
            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),
            Column::make('E-mail', 'email')
                ->searchable()
                ->sortable()
                ->format(function(User $model) {
                    return $this->mailto($model->email, null, ['target' => '_blank']);
            }),
            Column::make('Actions')
                ->format(function(User $model) {
                    return view('livewire.users.table-actions', ['user' => $model]);
            }),
        ];
    }
}