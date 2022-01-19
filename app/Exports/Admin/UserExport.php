<?php

namespace App\Exports\Admin;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Actions;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserExport implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        return User::select( User::raw('ROW_NUMBER() OVER (ORDER BY name) AS no'), "name", "email", "hak_akses")->get();
    }

    public function headings() :array
    {
        return [
            'No',
            'Nama',
            'Email',
            'Hak Akses',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->freezePane('A2');
   
            },
        ];
    }

    // public function collection()
    // {
    //     return [
    //         (new DownloadExcel)->only('name', 'email'),
    //     ];
    // }

    // public function map($user): array
    // {
    //     return [
    //         $user->no,
    //         $user->nama,
    //         $user->email,
    //         $user->hak_akses,
    //         Date::dateTimeToExcel($user->created_at)
    //     ];
    // }
    
    // public function columnFormats(): array
    // {
    //     return [
    //         'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
    //     ];
    // }

}
