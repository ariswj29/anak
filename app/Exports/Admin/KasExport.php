<?php

namespace App\Exports\Admin;

use App\Models\Kas;
use App\Models\Siklus;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
// use Carbon\Carbon;
use Illuminate\Support\Carbon;
use DB;

class KasExport extends DefaultValueBinder implements WithCustomValueBinder, FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $siklus_id;

    function __construct($siklus_id) {
        $this->siklus_id = $siklus_id;
        $kas = Kas::select( 
            'kas.tanggal',
            'kas.uraian',
            'kas.vol',
            // 'siklus.kode',
            // 'siklus.tanggal',
            // 'siklus.siklus_id',
            'satuan.satuan',
            'kas.harga_satuan',
            'kategori.kategori', 
            'jenis_transaksi.jenis_transaksi',
            Kas::raw('kas.vol*kas.harga_satuan as jumlah'))
            ->join('siklus','siklus.siklus_id', '=', 'kas.siklus_id')
            ->join('satuan','satuan.satuan_id', '=', 'kas.satuan_id')
            ->join('kategori','kategori.kategori_id', '=', 'kas.kategori_id')
            ->join('jenis_transaksi','jenis_transaksi.jenis_transaksi_id', '=', 'kas.jenis_transaksi_id')
            ->where('kas.siklus_id', '=', $siklus_id)
            ->whereNull('kas.deleted_at')
            ->orderBy('kas.tanggal')
            ->get();

            $this->kas=$kas;
            // $this->tgl = $kas->tanggal;
            $siklus = Siklus::find($siklus_id);
            $this->nama_siklus = $siklus->nama_siklus;
            $this->tanggal_mulai = $siklus->tanggal_mulai;
            $this->tanggal_selesai = $siklus->tanggal_selesai;
            $this->kode_siklus = $siklus->kode;
        return $this;
    }

    public function collection()
    {
        return $this->kas;
    }

    public function headings() :array
    {
        return [['BUKU KAS', '', '', 'Kode Siklus* :', $this->kode_siklus],
            ['Mitra Ternak Mardawa Farm', '', '', 'Tanggal Mulai * :', $this->tanggal_mulai],
            // ['Mitra Ternak Mardawa Farm', 'Tanggal Mulai * :', Siklus::get('tanggal')->where($siklus_id)],
            [$this->nama_siklus, '', '', 'Tanggal Selesai * :', $this->tanggal_selesai],
            ['TANGGAL',
            'URAIAN',
            'VOL',
            'SATUAN',
            'HARGA SATUAN',
            'KATEGORI',
            'JENIS TRANSAKSI',
            'JUMLAH',
            'KET',]
        ];
    }

    // public function model(array $row)
    // {
    //     return new user([
    //         'tanggal' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal']),
    //         'uraian' => $row['uraian'],
    //         'vol' => $row['vol'],
    //         'satuan' => $row['satuan'],
    //         'harga_satuan' => $row['harga_satuan'],
    //         'kategori' => $row['kategori'],
    //         'jenis_transaksi' => $row['jenis_transaksi'],
    //         'jumlah' => $row['jumlah'],
    //         'ket' => $row['ket'],
    //         // 'birth-date' => $this->transformDate($row[2]),
    //     ]);
    // }
    
    // public function map($kas): array{
    //     return [
    //         // Date::dateTimeToExcel($kas->tanggal),
    //         \PhpOffice\PhpSpreadsheet\Shared\Date::dateTimeToExcel(Carbon::parse($kas->tanggal)),
    //         // Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($kas->tanggal)),
    //         // \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($kas->tanggal)->format('d/m/Y'),
    //         $kas->uraian,
    //         $kas->vol,
    //         $kas->satuan,
    //         $kas->harga_satuan,
    //         $kas->kategori,
    //         $kas->jenis_transaksi,
    //         $kas->jumlah,
    //         $kas->ket,
    //     ];
    // }

    // public function columnFormats(): array
    // {
    //     return [
    //         'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
    //     ];
    // }

    // public function transformDate($value, $format = 'd-MMM-Y')
    // {
    //     try {
    //         return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
    //     } catch (\ErrorException $e) {
    //         return \Carbon\Carbon::createFromFormat($format, $value);
    //     }
    // }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
            
        }

        // if (in_array($cell->getColumn(), $this->tanggal)) {
        //     $cell->setValueExplicit(Date::excelToDateTimeObject($value)->format($this->tanggal), DataType::TYPE_STRING);

        //     return true;
        // }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }


    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/img/mardawavector.png'));
        $drawing->setHeight(30);
        $drawing->setCoordinates('F1');

        return $drawing;
    }

    public function registerEvents(): array
    {
        $styleArray = [
            'background' => [
                'color'=> ['argb' => 'A2188308']
            ],
            'font' => [
                'name' => 'Arial',
                'bold' => true,
                'size' => '11px',
                'color'=> ['argb' => 'A2FFFFFF']
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];    
        
        $styleArray1 = [
            'font' => [
                'name' => 'Arial',
                'bold' => true,
                'size' => '18px',
                'color' => ['argb' => 'A2188308'],
                // 'color' => '#188308'
            ]
        ];    
        
        $styleArray2 = [
            'font' => [
                'name' => 'Arial',
                'bold' => true,
                'size' => '14px',
                'color' => ['argb' => 'A2188308'],
                // 'color' => '#188308'
            ]
        ];  
        
        $styleArray3 = [
            'font' => [
                'name' => 'Arial',
                'size' => '12px',
                'color' => ['argb' => 'A2188308'],
            ]
        ];  
        
        $styleArray4 = [
            'font' => [
                'name' => 'Arial',
                'size' => '10px',
            ]
        ];  

        $alignTanggal = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];  
        
        $alignVol = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];  
        
        $alignSatuan = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];  
        
        $alignHarSat = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
            ],
        ];  
        
        $alignJumlah = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
            ],
        ];  

        return [
            // BeforeExport::class  => function(BeforeExport $event) {
            //     $event->writer->setCreator('Buku Kas');
            // },

            AfterSheet::class    => function(AfterSheet $event) use ($styleArray, $styleArray1, $styleArray2, $styleArray3, $styleArray4, $alignTanggal, $alignVol, $alignSatuan, $alignHarSat, $alignJumlah) {
                $event->sheet->getStyle('A4:I4')->applyFromArray($styleArray);
                $event->sheet->getStyle('A1')->applyFromArray($styleArray1);
                $event->sheet->getStyle('A2')->applyFromArray($styleArray2);
                $event->sheet->getStyle('A3')->applyFromArray($styleArray3);
                $event->sheet->getStyle('D1:E3')->applyFromArray($styleArray4);
                $event->sheet->getStyle('A5:A100')->applyFromArray($alignTanggal);
                $event->sheet->getStyle('C5:C100')->applyFromArray($alignVol);
                $event->sheet->getStyle('D5:D100')->applyFromArray($alignSatuan);
                $event->sheet->getStyle('E5:E100')->applyFromArray($alignHarSat);
                $event->sheet->getStyle('H5:H100')->applyFromArray($alignJumlah);

                $event->sheet->getDelegate()->freezePane('A5');
                
                $event->sheet->getDelegate()->getStyle('A4:I4')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('A2188308');

                // $event->sheet->getColumnDimension('A4:I4')->setWidth(32);

                // $event->sheet->getDelegate()->freezePane('C100');
            //     $event->sheet->getDelegate()->getStyle('A1:'.$event->sheet->getDelegate()->getHighestColumn().'1')
            // ->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('ffff15');
                
            // $event->sheet->styleCells(
            //     'A5:I5',
            //     [
            //         'borders' => [
            //             'outline' => [
            //                 'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            //                 'color' => ['argb' => 'FFFF0000'],
            //             ],
            //         ]
            //     ]
            // );

                // $event->sheet->getDelegate()->getStyle('A1','B1')
                // ->getFill()
                // ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                // ->getStartColor()
                // ->setARGB('EB2B02');    

                // $event->sheet->styleCells(
                //     'A4:I4',
                //     [
                //         //Set border Style
                //     'borders' => [ 
                //         'outline' => [
                //             'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                //             'color' => ['argb' => 'EB2B02'],
                //         ],

                //     ],

                //     //Set font style
                //     'font' => [
                //         'name'      =>  'Calibri',
                //         'size'      =>  15,
                //         'bold'      =>  true,
                //         'color' => ['argb' => '0.8, 248, 248, 248'],
                //     ],

                //     //Set background style
                //     'fill' => [
                //         'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                //         'startColor' => [
                //             'rgb' => '24, 131, 8',
                //          ]           
                //     ],
                //     ]
                // );


                $event->sheet->mergeCells('A2:B2');
            },
        ];
    }
}
