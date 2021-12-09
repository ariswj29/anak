<?php

namespace App\Http\Controllers\Mitra;

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
            row_number() over(ORDER BY minum.tanggal DESC) AS no,
            minum.minum_id,
            siklus.nama_siklus,
            minum.jumlah_minum,
            minum.tanggal,
            farm.nama_farm
        FROM
            minum
            JOIN siklus on minum.siklus_id = siklus.siklus_id
            JOIN farm ON siklus.farm_id = farm.farm_id
            JOIN mitra ON farm.mitra_id = mitra.mitra_id 
        WHERE
            mitra.email = '".Auth::user()->email."'
            AND minum.deleted_at IS NULL"));

        $minums = Minum::all();
        $sikluses = Siklus::all();

        return view('mitra/minum')->with(array('minums'=> $minums, 'sikluses'=> $sikluses, 'recording'=> $recording));
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
            minum.siklus_id,
            siklus.nama_siklus
        FROM
            minum
            JOIN siklus on minum.siklus_id = siklus.siklus_id
        WHERE
            minum.siklus_id = 1 "));

        return view('mitra/tambah_minum')->with('sikluses', $sikluses);;
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

        return redirect('/mitra/minum')->with('status', 'Data minum berhasil ditambahkan');
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
            mitra.email = '".Auth::user()->email."' "));
        
        return view('mitra/edit_minum')->with('minums', $minums)->with('sikluses', $sikluses);
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

        return redirect('/mitra/minum')->with('status', 'Data minum berhasil ditambahkan');
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

        return redirect('/mitra/minum');
    }
}
