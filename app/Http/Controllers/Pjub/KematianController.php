<?php

namespace App\Http\Controllers\Pjub;

use App\Http\Controllers\Controller;
use App\Models\Kematian;
use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class KematianController extends Controller
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
            ROW_NUMBER ( ) OVER ( ORDER BY kematian.tanggal ASC ) AS NO,
            kematian.kematian_id,
            siklus.nama_siklus,
            mitra.nama,
            kematian.jumlah_kematian,
            kematian.tanggal, 
            kematian.penyebab, 
            farm.nama_farm
        FROM
            kematian
            JOIN siklus ON kematian.siklus_id = siklus.siklus_id
            JOIN farm ON siklus.farm_id = farm.farm_id
            JOIN mitra ON farm.mitra_id = mitra.mitra_id 
            LEFT JOIN pjub ON pjub.pjub_id = mitra.pjub_id
        WHERE
            pjub.email = '".Auth::user()->email."'
            and kematian.deleted_at IS Null"));

        $kematians = Kematian::all();
        $sikluses = Siklus::all();

        return view('pjub/kematian')->with(array('kematians'=> $kematians, 'recording'=> $recording, 'sikluses'=> $sikluses));
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
            siklus.siklus_id,
            farm.nama_farm 
        FROM
            siklus
            JOIN farm ON siklus.farm_id = farm.farm_id
            JOIN mitra ON farm.mitra_id = mitra.mitra_id 
            LEFT JOIN pjub ON pjub.pjub_id = mitra.pjub_id
        WHERE
            pjub.email = '".Auth::user()->email."' "));
        return view('pjub/tambah_kematian')->with('sikluses', $sikluses);
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
            'penyebab' => '',
            ]);

        $data = request()->all();

        $kematian = new Kematian();
        $kematian->siklus_id = $data['siklus_id'];
        $kematian->tanggal = $data['tanggal'];
        $kematian->jumlah_kematian = $data['jumlah_kematian'];
        $kematian->penyebab = $data['penyebab'];

        $kematian->save();

        session()->flash('success', 'Data Berhasil Ditambah');

        return redirect('/pjub/kematian')->with('status', 'Data kematian berhasil ditambahkan');
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
            siklus.siklus_id,
            farm.nama_farm 
        FROM
            kematian
            JOIN siklus ON kematian.siklus_id = siklus.siklus_id
            JOIN farm ON siklus.farm_id = farm.farm_id
        WHERE
            kematian.kematian_id = $kematian_id "));
        
        return view('pjub/edit_kematian')->with('kematians', $kematians)->with('sikluses', $sikluses);
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
            'penyebab' => 'required',
            ]);

        $data = request()->all();

        $kematian = Kematian::find($kematian_id);
        $kematian->siklus_id = $data['siklus_id'];
        $kematian->tanggal = $data['tanggal'];
        $kematian->jumlah_kematian = $data['jumlah_kematian'];
        $kematian->penyebab = $data['penyebab'];

        $kematian->save();

        session()->flash('success', 'Data Berhasil Diubah');

        return redirect('/pjub/kematian')->with('status', 'Data kematian berhasil ditambahkan');
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

        return redirect('/pjub/kematian');
    }
}
