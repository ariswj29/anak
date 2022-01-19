<?php

namespace App\Exports\Admin;

use App\Models\Kematian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class KematianExport extends DefaultValueBinder implements WithCustomValueBinder, FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kematian::select( Kematian::raw('ROW_NUMBER() OVER (ORDER BY siklus.nama_siklus) AS no'), "siklus.nama_siklus", "kematian.tanggal", "jumlah_kematian", "penyebab", "farm.nama_farm", "mitra.nama")
        ->Join('siklus', 'siklus.siklus_id', '=', 'kematian.siklus_id')
        ->LeftJoin('farm', 'farm.farm_id', '=', 'siklus.farm_id')
        ->LeftJoin('mitra', 'mitra.mitra_id', '=', 'farm.mitra_id')->get();
    }

    public function headings() :array
    {
        return [
            'No',
            'Nama Siklus',
            'Tanggal',
            'Jumlah Kematian',
            'Penyebab',
            'Nama Farm',
            'Nama Mitra',
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->freezePane('A2');
            },
        ];
    }
}
