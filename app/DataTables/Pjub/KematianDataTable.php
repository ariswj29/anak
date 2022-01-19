<?php

namespace App\DataTables\Pjub;

use App\Models\Kematian;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Auth;

class KematianDataTable extends DataTable
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
            ->addColumn('action', 'kematiandatatable.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\KematianDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(KematianDataTable $model)
    {
        // return $model->newQuery();
        $data = Kematian::select('*','farm.nama_farm', 'siklus.nama_siklus', 'mitra.nama')
        ->Join('siklus', 'siklus.siklus_id', '=', 'kematian.siklus_id')
        ->LeftJoin('farm', 'farm.farm_id', '=', 'siklus.farm_id')
        ->LeftJoin('mitra', 'mitra.mitra_id', '=', 'farm.mitra_id')
        ->LeftJoin('pjub', 'pjub.pjub_id', '=', 'mitra.pjub_id')
        ->where('pjub.email', '=', Auth::user()->email);;
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
                    ->setTableId('kematiandatatable-table')
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
        return 'Kematian_' . date('YmdHis');
    }
}
