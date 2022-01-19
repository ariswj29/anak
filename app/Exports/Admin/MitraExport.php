<?php

namespace App\Exports\Admin;

use App\Models\Mitra;
use App\Models\Pjub;
use Illuminate\Support\Collection;
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

class MitraExport extends DefaultValueBinder implements WithCustomValueBinder, FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mitra::select( Mitra::raw('ROW_NUMBER() OVER (ORDER BY mitra.nama) AS no'), "pjub.nama as pjub", "mitra.nama", "mitra.nik", "mitra.tempat_lahir", "mitra.tanggal_lahir", "mitra.alamat", "mitra.no_hp", "mitra.email")->Join('pjub', 'pjub.pjub_id', '=', 'mitra.pjub_id')->get();
    }

    public function headings() :array
    {
        return [
            'No',
            'PJUB',
            'Nama',
            'NIK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat',
            'No Handphone',
            'Email',
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
