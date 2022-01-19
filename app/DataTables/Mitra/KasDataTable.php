<?php

namespace App\DataTables\Mitra;

use App\Models\Kas;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KasDataTable extends DataTable
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
            ->addColumn('action', 'kasdatatable.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\KasDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(KasDataTable $model)
    {
        // return $model->newQuery();
        $data = Kas::select('siklus.siklus_id',
            'kas.kas_id',
            'kas.tanggal',
            'kas.nama',
            'kas.vol',
            'satuan.satuan',
            'kas.harga_satuan',
            // 'kategori.kategori',
            'jenis_transaksi.jenis_transaksi_id ')
        ->Join('siklus ON siklus.siklus_id = kas.siklus_id')
        ->Join('satuan ON satuan.satuan_id = kas.satuan_id')
        ->Join('kategori ON kategori.kategori_id = kas.kategori_id')
        ->Join('jenis_transaksi ON jenis_transaksi.jenis_transaksi_id = kas.jenis_transaksi_id');
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
                    ->setTableId('kasdatatable-table')
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
        return 'Mitra\Kas_' . date('YmdHis');
    }
}
