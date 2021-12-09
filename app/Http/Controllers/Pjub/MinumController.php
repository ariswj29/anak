<?php

namespace App\Http\Controllers\Pjub;

use App\Http\Controllers\Controller;
use App\Models\Minum;
use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class MinumController extends Controller
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
            row_number() over(ORDER BY minum ASC) AS no,
            minum.minum_id,
            siklus.nama_siklus,
            farm.nama_farm,
            mitra.nama,
            minum.jumlah_minum,
            minum.tanggal
        FROM
            minum
            JOIN siklus on minum.siklus_id = siklus.siklus_id
            JOIN farm ON siklus.farm_id = farm.farm_id
            JOIN mitra ON farm.mitra_id = mitra.mitra_id 
            LEFT JOIN pjub ON pjub.pjub_id = mitra.pjub_id
        WHERE
            pjub.email = '".Auth::user()->email."'
            and minum.deleted_at IS Null"));

        $minums = Minum::all();
        $sikluses = Siklus::all();

        return view('pjub/minum')->with(array('minums'=> $minums, 'sikluses'=> $sikluses, 'recording'=> $recording));
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
            siklus.siklus_id,
            siklus.nama_siklus,
            farm.nama_farm
        FROM
            siklus
            JOIN farm ON siklus.farm_id = farm.farm_id
            JOIN mitra ON farm.mitra_id = mitra.mitra_id 
            LEFT JOIN pjub ON pjub.pjub_id = mitra.pjub_id
        WHERE
            pjub.email = '".Auth::user()->email."' AND siklus.deleted_at IS NULL"));

        return view('pjub/tambah_minum')->with('sikluses', $sikluses);;
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
            'jumlah_minum' => 'required',
            'tanggal' => 'required',
            ]);

        $data = request()->all();

        $minum = new Minum();
        $minum->siklus_id = $data['siklus_id'];
        $minum->jumlah_minum = $data['jumlah_minum'];
        $minum->tanggal = $data['tanggal'];

        $minum->save();

        session()->flash('success', 'Data Berhasil Ditambah');

        return redirect('/pjub/minum')->with('status', 'Data minum berhasil ditambahkan');
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
    public function edit($minum_id)
    {
        $minums = Minum::find($minum_id);
        $sikluses = \DB::select(\DB::raw("
        SELECT
            minum.siklus_id,
            siklus.nama_siklus
        FROM
            minum
            JOIN siklus on minum.siklus_id = siklus.siklus_id
            JOIN farm ON siklus.farm_id = farm.farm_id
            JOIN mitra ON farm.mitra_id = mitra.mitra_id
        WHERE
            minum.minum_id = $minum_id "));
        
        return view('pjub/edit_minum')->with('minums', $minums)->with('sikluses', $sikluses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $minum_id)
    {
        $this->validate(request(),[
            'siklus_id' => 'required',
            'jumlah_minum' => 'required',
            'tanggal' => 'required',
            ]);

        $data = request()->all();

        $minum = Minum::find($minum_id);
        $minum->siklus_id = $data['siklus_id'];
        $minum->jumlah_minum = $data['jumlah_minum'];
        $minum->tanggal = $data['tanggal'];

        $minum->save();

        session()->flash('success', 'Data Berhasil Diubah');

        return redirect('/pjub/minum')->with('status', 'Data minum berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($minum_id)
    {
        $minum = Minum::find($minum_id);

        $minum->delete();

        session()->flash('success', 'Data Berhasil Dihapus');

        return redirect('/pjub/minum');
    }
}
