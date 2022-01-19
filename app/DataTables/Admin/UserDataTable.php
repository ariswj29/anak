<?php

namespace App\DataTables\Admin;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query); 
            // ->addColumn('action', 'userdatatable.action');

        // return DataTables::eloquent($model)
        //         ->addColumn('link', '<a href="#">Html Column</a>')
        //         ->addColumn('action', 'path.to.view')
        //         ->rawColumns(['link', 'action'])
        //         ->toJson();

        // return datatables::eloquent($model)
        //         ->eloquent($query)
        //         ->addColumn('intro', 'Hi {{$name}}!')
        //         ->toJson();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\UserDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserDataTable $model)
    {
        // return $model->newQuery();
        $data = User::select('*');
        return $this->applyScopes($data);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('userdatatable-table')
                    // ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->dom('Bfrtip')
                    ->buttons(
                    //     Button::make('create')->editor('editor'),
                    //     Button::make('edit')->editor('editor'),
                    //     Button::make('remove')->editor('editor'),
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf')
                    );
                    // ->editor(
                    //     Editor::make()
                    //         ->fields([
                    //             Fields\Text::make('name'),
                    //             Fields\Text::make('email'),
                    //             Fields\Password::make('password'),
                    //         ])
                    // );
                    // ->parameters([
                        // 'dom' => ['Bfrtip'],
                        // 'buttons' => ['excel', 'csv', 'pdf'],
                    // ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    // protected function getColumns()
    // {
    //     return [
    //         Column::make('id')
    //               ->data('id')
    //             //   ->nama('id')
    //               ->title('No')
    //             //   ->footer('Id')
    //             //   ->render('function(){}')
    //               ->exportable(false)
    //               ->printable(false)
    //               ->width(60)
    //               ->addClass('text-center')
    //               ->return('meta.row + meta.settings._iDisplayStart + 1'),
    //         Column::make('name'),
    //         Column::make('email'),
    //         Column::make('hak_akses'),
    //         Column::make('action')
    //               ->name('action')
    //               ->oderable(false)
    //               ->searchable(false)
    //               ->defaultContent()
    //               ->data(null)
    //             //   ->render('function ( data, type, row ){<button>...</button>}'),

    //         // { data: 'no', name:'id', render: function (data, type, row, meta) {
    //         //     return meta.row + meta.settings._iDisplayStart + 1;
    //         // }}
    //         // Column::make('created_at'),
    //         // Column::make('updated_at'),
    //     ];
    // }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
