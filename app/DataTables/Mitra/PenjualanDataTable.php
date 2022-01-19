<?php

namespace App\DataTables\Mitra;

use App\Models\Penjualan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Auth;

class PenjualanDataTable extends DataTable
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
            ->eloquent($query)
            ->addColumn('action', 'penjualandatatable.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PenjualanDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PenjualanDataTable $model)
    {
        // return $model->newQuery();
        $data = penjualan::select('penjualan.penjualan_id','penjualan.tanggal', 'penjualan.jumlah', 'penjualan.bobot_jual', 'penjualan.jumlah_nominal', 'farm.nama_farm', 'penjualan.foto', 'siklus.nama_siklus', 'mitra.nama')
        ->Join('siklus', 'siklus.siklus_id', '=', 'penjualan.siklus_id')
        ->LeftJoin('farm', 'farm.farm_id', '=', 'siklus.farm_id')
        ->LeftJoin('mitra', 'mitra.mitra_id', '=', 'farm.mitra_id')
        ->where('mitra.email', '=', Auth::user()->email);
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
                    ->setTableId('mitra\penjualandatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
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
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Mitra\Penjualan_' . date('YmdHis');
    }
}
