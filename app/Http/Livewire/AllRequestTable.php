<?php

namespace App\Http\Livewire;

use App\Models\Request;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

class AllRequestTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp()
    {
        $this->showPerPage()
            ->showSearchInput();
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    public function datasource(): ?Builder
    {
        return Request::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('description')
            ->addColumn('invoice', function(Request $model) {
                return "<a href='../../assets/invoices/".$model->invoice."' download>".$model->invoice."</a>";
            })
            ->addColumn('prf', function(Request $model) {
                return "<a href='../../assets/prf/".$model->prf."' download>".$model->prf."</a>";
            })
            ->addColumn('feedback')
            ->addColumn('status', function(Request $model) {
                $classes = "badge rounded-pill text-uppercase m-3 p-2 ";
                if(str_contains($model->status, 'Request Raised')){
                    $classes .= "bg-primary text-white";
                }else if(str_contains($model->status, 'Approved By Manager')){
                    $classes .= "bg-warning text-dark";
                }else if(str_contains($model->status, 'Approved By Accounts Team')){
                    $classes .= "bg-success text-white";
                }else if(str_contains($model->status, 'Denied')){
                    $classes .= "bg-danger text-white";
                }else if(str_contains($model->status, 'Completed')){
                    $classes .= "bg-dark text-white";
                }else{
                    $classes .= "bg-info text-dark";
                }
                return "<a href='./request/" .$model->id. "'><span class='" .$classes. "'>" .$model->status. "</span></a>";
            })
            ->addColumn('raised_by', function(Request $model) {
                return $model->raisedBy->email;
            })
            ->addColumn('raised_to',function(Request $model) {
                return $model->raisedTo->email;
            })
            ->addColumn('created_at_formatted', function(Request $model) {
                return Carbon::parse($model->created_at)->format('d/m/Y H:i:s');
            })
            ->addColumn('updated_at_formatted', function(Request $model) {
                return Carbon::parse($model->updated_at)->format('d/m/Y H:i:s');
            });
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */
    public function columns(): array
    {
        return [
            Column::add()
                ->title(__('ID'))
                ->field('id')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('STATUS'))
                ->field('status')
                ->bodyAttribute('text-center')
                ->sortable()
                ->searchable(),
                // ->makeInputSelect(Status::all(), 'type', 'status', ['live-search' => true]),

            Column::add()
                ->title(__('DESCRIPTION'))
                ->field('description')
                ->searchable(),

            Column::add()
                ->title(__('INVOICE'))
                ->field('invoice')
                ->searchable(),

            Column::add()
                ->title(__('PRF'))
                ->field('prf')
                ->searchable(),

            Column::add()
                ->title(__('FEEDBACK'))
                ->field('feedback')
                ->searchable(),

            Column::add()
                ->title(__('RAISED BY'))
                ->field('raised_by')
                ->searchable(),
                // ->makeInputSelect(User::all(), 'email', 'id', ['live-search' => true]),

            Column::add()
                ->title(__('RAISED TO'))
                ->field('raised_to')
                ->searchable(),
                // ->makeInputSelect(User::all(), 'email', 'id', ['live-search' => true]),

            Column::add()
                ->title(__('CREATED AT'))
                ->field('created_at_formatted')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('created_at'),

            Column::add()
                ->title(__('UPDATED AT'))
                ->field('updated_at_formatted')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('updated_at'),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable this section only when you have defined routes for these actions.
    |
    */

    /*
    public function actions(): array
    {
       return [
           Button::add('edit')
               ->caption(__('Edit'))
               ->class('bg-indigo-500 text-white')
               ->route('request.edit', ['request' => 'id']),

           Button::add('destroy')
               ->caption(__('Delete'))
               ->class('bg-red-500 text-white')
               ->route('request.destroy', ['request' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Edit Method
    |--------------------------------------------------------------------------
    | Enable this section to use editOnClick() or toggleable() methods
    |
    */

    /*
    public function update(array $data ): bool
    {
       try {
           $updated = Request::query()->find($data['id'])->update([
                $data['field'] => $data['value']
           ]);
       } catch (QueryException $exception) {
           $updated = false;
       }
       return $updated;
    }

    public function updateMessages(string $status, string $field = '_default_message'): string
    {
        $updateMessages = [
            'success'   => [
                '_default_message' => __('Data has been updated successfully!'),
                //'custom_field' => __('Custom Field updated successfully!'),
            ],
            'error' => [
                '_default_message' => __('Error updating the data.'),
                //'custom_field' => __('Error updating custom field.'),
            ]
        ];

        return ($updateMessages[$status][$field] ?? $updateMessages[$status]['_default_message']);
    }
    */

    public function template(): ?string
    {
        return null;
    }

}
