<?php

namespace App\Exports\Pjub;

use App\Models\Farm;
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
use Auth;


class FarmExport extends DefaultValueBinder implements WithCustomValueBinder, FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Farm::select( Farm::raw('ROW_NUMBER() OVER (ORDER BY mitra.nama) AS no'), "mitra.nama", "nama_farm", "alamat_farm", "mata_uang", "kapasitas_rak_telur", "kapasitas_kandang_doc", "kapasitas_kandang_grower")
        ->Join('mitra', 'mitra.mitra_id', '=', 'farm.mitra_id')
        ->LEFTJOIN( 'pjub', 'pjub.pjub_id', '=', 'mitra.pjub_id') 
        ->where('pjub.email', '=', Auth::user()->email)->get();

        // dd($export);
        // die();
        
    }

    public function headings() :array
    {
        return [
            'No',
            'Mitra',
            'Farm',
            'Alamat Farm',
            'Mata Uang',
            'kapasitas Rak Telur',
            'Kapasitas Kandang DOC',
            'Kapasitas Kandang Grower',
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
