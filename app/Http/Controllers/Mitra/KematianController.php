<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Kematian;
use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\DataTables\Mitra\KematianDataTable;
use App\Exports\Mitra\KematianExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class KematianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KematianDataTable $dataTable)
    {
        // $recording = \DB::select(\DB::raw("
        // SELECT 
        //     ROW_NUMBER ( ) OVER ( ORDER BY kematian.tanggal DESC ) AS NO,
        //     kematian.kematian_id,
        //     siklus.nama_siklus,
        //     kematian.jumlah_kematian,
        //     kematian.tanggal, 
        //     kematian.penyebab,
        //     farm.nama_farm
        // FROM
        //     kematian
        //     JOIN siklus ON kematian.siklus_id = siklus.siklus_id
        //     JOIN farm ON siklus.farm_id = farm.farm_id
        //     JOIN mitra ON farm.mitra_id = mitra.mitra_id 
        // WHERE
        //     mitra.email = '".Auth::user()->email."'
        //     AND kematian.deleted_at IS NULL"));

        // $kematians = Kematian::all();
        // $sikluses = Siklus::all();

        // return view('mitra/kematian')->with(array('kematians'=> $kematians, 'recording'=> $recording, 'sikluses'=> $sikluses));

        return $dataTable->render('mitra/kematian');
    
        return view('mitra/kematian',['kematian'=>$kematian]);
    }

    public function export_excel()
    {
        return Excel::download(new KematianExport, 'Kematian.xlsx');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $sikluses = \DB::select(\DB::raw("
        SELECT
            siklus.nama_siklus,
            siklus.siklus_id 
        FROM
            kematian
            JOIN siklus ON kematian.siklus_id = siklus.siklus_id
        WHERE
            kematian.siklus_id = 1 "));
        return view('mitra/tambah_kematian')->with('sikluses', $sikluses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'siklus_id' => 'required',
            'tanggal' => 'required',
            'jumlah_kematian' => 'required',
            ]);

        $data = request()->all();

        $kematian = new Kematian();
        $kematian->siklus_id = $data['siklus_id'];
        $kematian->tanggal = $data['tanggal'];
        $kematian->jumlah_kematian = $data['jumlah_kematian'];

        $kematian->save();

        session()->flash('success', 'Data Berhasil Ditambah');

        return redirect('/mitra/kematian')->with('status', 'Data kematian berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kematian_id)
    {
        $kematians = Kematian::find($kematian_id);
        $sikluses = \DB::select(\DB::raw("
        SELECT
            siklus.nama_siklus,
            siklus.siklus_id 
        FROM
            kematian
            JOIN siklus ON kematian.siklus_id = siklus.siklus_id
            JOIN farm ON siklus.farm_id = farm.farm_id
            JOIN mitra ON farm.mitra_id = mitra.mitra_id
        WHERE
            mitra.email = '".Auth::user()->email."' "));
        
        return view('mitra/edit_kematian')->with('kematians', $kematians)->with('sikluses', $sikluses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kematian_id)
    {
        $this->validate(request(),[
            'siklus_id' => 'required',
            'tanggal' => 'required',
            'jumlah_kematian' => 'required',
            ]);

        $data = request()->all();

        $kematian = Kematian::find($kematian_id);
        $kematian->siklus_id = $data['siklus_id'];
        $kematian->tanggal = $data['tanggal'];
        $kematian->jumlah_kematian = $data['jumlah_kematian'];

        $kematian->save();

        session()->flash('success', 'Data Berhasil Diubah');

        return redirect('/mitra/kematian')->with('status', 'Data kematian berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kematian_id)
    {
        $kematian = Kematian::find($kematian_id);

        $kematian->delete();

        session()->flash('success', 'Data Berhasil Dihapus');

        return redirect('/mitra/kematian');
    }
}
