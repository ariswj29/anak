<?php

namespace App\Exports\Admin;

use App\Models\Pjub;
use Maatwebsite\Excel\Concerns\FromCollection;
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

class PjubExport extends DefaultValueBinder implements WithCustomValueBinder, FromCollection, WithHeadings, WithEvents, ShouldAutoSize, WithProperties
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pjub::select( Pjub::raw('ROW_NUMBER() OVER (ORDER BY pjub.nama) AS no'), "nama", "nik", "tempat_lahir", "tanggal_lahir", "alamat", "no_hp", "email")->get();
    }

    public function properties(): array
    {
        return [
            'title'          => 'Invoices Export',
        ];
    }

    public function headings() :array
    {
        return [
            'No',
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
