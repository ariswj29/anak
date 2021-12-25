<?php

namespace App\DataTables;

use App\Models\Opex;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Collection;
use DB;

class OpexDataTable extends DataTable
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
            ->queryBuilder($query);
            // ->eloquent($query);
            // ->addColumn('action', 'opex.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Opex $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Opex $model=null, $siklus_id)
    {
        // return $dataTable->with('siklus_id');
        // dd($siklus_id);
                // ->with([
                //     'opex_id' => $opex_id,
                //     'siklus_id' => $siklus_id
                // ]);

        // return $model->newQuery();
        // $data = Opex::select('*');
        $data = DB::table('opex')
                ->select(
                    DB::raw('ROW_NUMBER () OVER ( ORDER BY opex.opex_id ASC ) AS NO'),
                    'siklus.siklus_id',
                    'opex.opex_id',
                    'opex.opex',
                    'opex.jumlah',
                    'opex.harga',
                    'opex.satuan',
                    DB::raw('( jumlah * harga ) AS subtotal'),
                    'opex.keterangan'
                )
                ->leftJoin('siklus', 'siklus.siklus_id', '=', 'opex.siklus_id')
                ->where('opex.siklus_id', $siklus_id)
                ->whereNull('opex.deleted_at');
                // ->get();
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
                    ->setTableId('opex-table')
                    ->columns($this->getColumns())
                    // ->minifiedAjax()
                    // ->dom('Bfrtip');
                    ->parameters([
                        'dom'          => 'Bfrtip',
                        'buttons'      => ['export', 'print', 'reset', 'reload'],
                    ]);
                    // ->buttons(
                    //     Button::make('csv'),
                    //     Button::make('excel'),
                    //     Button::make('print')
                    // );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('opex_id'),
            Column::make('opex'), 
            Column::make('jumlah'), 
            Column::make('harga'), 
            Column::make('satuan'), 
            Column::make('subtotal'), 
            Column::make('keterangan'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
            // Column::make('deleted_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Opex_' . date('YmdHis');
    }
}
