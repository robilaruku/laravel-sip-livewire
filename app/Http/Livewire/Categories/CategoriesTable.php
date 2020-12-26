<?php

namespace App\Http\Livewire\Categories;

use App\Category;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CategoriesTable extends TableComponent
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
        return Category::query();
    }

    public function columns() : array
    {
        return [
            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),
            Column::make('Status', 'status')
                ->searchable()
                ->sortable(),
            Column::make('Actions')
                ->format(function(Category $model) {
                    return view('admin.categories.datatables_action', ['Category' => $model]);
            })->excludeFromExport(),
        ];
    }
}