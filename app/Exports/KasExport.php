<?php

namespace App\Exports;

use App\Models\Kas;
use Maatwebsite\Excel\Concerns\FromCollection;

class KasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kas::all();
    }
}
