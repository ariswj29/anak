<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siklus;
use App\Models\Farm;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use PDF;
use App\DataTables\SiklusDataTable;
use App\Exports\SiklusExport;
use Maatwebsite\Excel\Facades\Excel;

class SiklusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SiklusDataTable $dataTable)
        {
            // $sikluses = Siklus::all();
            // $farms = farm::all();

            // return view('admin/siklus')->with(array('sikluses'=> $sikluses, 'farms'=> $farms));
        
            return $dataTable->render('admin/siklus');
    
            return view('admin/siklus',['siklus'=>$siklus]);
        }
 
    public function export_excel()
    {
        return Excel::download(new SiklusExport, 'Siklus.xlsx');
    }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        
    // public function exportPDF() 
    // {
       
    //     $sikluses = Siklus::all();
  
    //     $pdf = PDF::loadView('admin/siklus', ['sikluses' => $sikluses]);
        
    //     return $pdf->download('siklus.pdf');
        
    // }    

    public function create()
    {
        $mitras = Mitra::all();
        $farms = farm::all();

        return view('admin/tambah_siklus')->with('farms', $farms)->with('mitras', $mitras);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate(request(),[
            'farm_id' => 'required',
            'nama_siklus' => 'required',
            'tanggal' => 'required',
            'jenis_ternak' => 'required',
            'jumlah_ternak' => 'required|max:4',
            'harga_satuan_doc' => 'required|max:6',
            'supplier' => 'required',
        ]);

        $data = request()->all();

        $siklus = new Siklus();
        $siklus->farm_id = $data['farm_id'];
        $siklus->nama_siklus = $data['nama_siklus'];
        $siklus->tanggal = $data['tanggal'];
        $siklus->jenis_ternak = $data['jenis_ternak'];
        $siklus->jumlah_ternak = $data['jumlah_ternak'];
        $siklus->harga_satuan_doc = $data['harga_satuan_doc'];
        $siklus->supplier = $data['supplier'];
        
        $siklus->save();

        session()->flash('success', 'Data Berhasil Ditambah');

        return redirect('/admin/siklus')->with('status', 'Data siklus berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($siklus_id)
    {
        //
        $sikluses = Siklus::find($siklus_id);
        $farms = Farm::all();

        return view('admin/edit_siklus')->with('sikluses', $sikluses)->with('farms', $farms);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $siklus_id)
    {
        //
        $this->validate(request(),[
            'farm_id' => 'required',
            'nama_siklus' => 'required',
            'tanggal' => 'required',
            'jenis_ternak' => 'required',
            'jumlah_ternak' => 'required|max:4',
            'harga_satuan_doc' => 'required|max:6',
            'supplier' => 'required',
        ]);

        $data = request()->all();

        $siklus = Siklus::Find($siklus_id);
        $siklus->farm_id = $data['farm_id'];
        $siklus->nama_siklus = $data['nama_siklus'];
        $siklus->tanggal = $data['tanggal'];
        $siklus->jenis_ternak = $data['jenis_ternak'];
        $siklus->jumlah_ternak = $data['jumlah_ternak'];
        $siklus->harga_satuan_doc = $data['harga_satuan_doc'];
        $siklus->supplier = $data['supplier'];
        
        $siklus->save();

        session()->flash('success', 'Data Berhasil Diubah');

        return redirect('/admin/siklus')->with('status', 'Data siklus berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($siklus_id)
    {
        //
        $siklus = siklus::find($siklus_id);

        $siklus->delete();

        session()->flash('success', 'Data Berhasil Dihapus');

        return redirect('/admin/siklus');
    }
}
