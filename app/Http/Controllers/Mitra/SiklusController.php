<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Siklus;
use App\Models\Farm;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use PDF;
use Auth;

class SiklusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        {
            $recording = \DB::select(\DB::raw("
        SELECT
            row_number() over(ORDER BY siklus ASC) AS no,
            siklus.siklus_id,
            farm.nama_farm,
            siklus.nama_siklus,
            siklus.tanggal,
            siklus.jenis_ternak,
            siklus.jumlah_ternak,
            siklus.harga_satuan_doc,
            siklus.supplier
        FROM
            siklus
            JOIN farm ON siklus.farm_id = farm.farm_id 
            JOIN mitra ON farm.mitra_id = mitra.mitra_id
        WHERE
	        mitra.email = '".Auth::user()->email."'"));
            $sikluses = Siklus::all();
            $farms = farm::all();

            return view('mitra/siklus')->with(array('sikluses'=> $sikluses, 'farms'=> $farms, 'recording'=> $recording));
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function exportPDF() 
    {
       
        $sikluses = Siklus::all();
  
        $pdf = PDF::loadView('mitra/siklus', ['sikluses' => $sikluses]);
        
        return $pdf->download('siklus.pdf');
        
    }    

    public function create()
    {
        $mitras = Mitra::all();
        $farms = \DB::select(\DB::raw("
        SELECT
            farm.nama_farm,
            farm.farm_id 
        FROM
            siklus
            JOIN farm ON siklus.farm_id = farm.farm_id
        WHERE
            siklus.siklus_id = 1 "));

        return view('mitra/tambah_siklus')->with('farms', $farms)->with('mitras', $mitras);
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

        return redirect('/mitra/siklus')->with('status', 'Data siklus berhasil ditambahkan');
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
        $farms = \DB::select(\DB::raw("
        SELECT
            farm.nama_farm,
            farm.farm_id 
        FROM
            siklus
            JOIN farm ON siklus.farm_id = farm.farm_id
        WHERE
            siklus.siklus_id = 1 "));

        return view('mitra/edit_siklus')->with('sikluses', $sikluses)->with('farms', $farms);
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

        return redirect('/mitra/siklus')->with('status', 'Data siklus berhasil diubah');

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

        return redirect('/mitra/siklus');
    }
}
