<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Vitamin;
use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class VitaminController extends Controller
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
            ROW_NUMBER ( ) OVER ( ORDER BY vitamin.tanggal ASC ) AS NO,
            vitamin.vitamin_id,
            siklus.nama_siklus,
            vitamin.jenis_vitamin,
            vitamin.jumlah_vitamin,
            vitamin.tanggal 
        FROM
            vitamin
            JOIN siklus ON vitamin.siklus_id = siklus.siklus_id
            JOIN farm ON siklus.farm_id = farm.farm_id
            JOIN mitra ON farm.mitra_id = mitra.mitra_id 
        WHERE
            mitra.email = '".Auth::user()->email."'"));

        $vitamins = Vitamin::all();
        $sikluses = Siklus::all();

        return view('mitra/vitamin')->with(array('vitamins'=> $vitamins, 'sikluses'=> $sikluses, 'recording'=> $recording));
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
            vitamin
            JOIN siklus ON vitamin.siklus_id = siklus.siklus_id
        WHERE
            vitamin.siklus_id = 1 "));
        return view('mitra/tambah_vitamin')->with('sikluses', $sikluses);
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
            'jenis_vitamin' => 'required',
            'jumlah_vitamin' => 'required',
            'tanggal' => 'required',
            ]);

        $data = request()->all();

        $vitamin = new Vitamin();
        $vitamin->siklus_id = $data['siklus_id'];
        $vitamin->jenis_vitamin = $data['jenis_vitamin'];
        $vitamin->jumlah_vitamin = $data['jumlah_vitamin'];
        $vitamin->tanggal = $data['tanggal'];

        $vitamin->save();

        session()->flash('success', 'Data Berhasil Ditambah');

        return redirect('/mitra/vitamin')->with('status', 'Data vitamin berhasil ditambahkan');
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
    public function edit($vitamin_id)
    {
        $vitamins = Vitamin::find($vitamin_id);
        $sikluses = \DB::select(\DB::raw("
        SELECT
            siklus.nama_siklus,
            siklus.siklus_id 
        FROM
            vitamin
            JOIN siklus ON vitamin.siklus_id = siklus.siklus_id
            JOIN farm ON siklus.farm_id = farm.farm_id
            JOIN mitra ON farm.mitra_id = mitra.mitra_id
        WHERE
            mitra.email = '".Auth::user()->email."'"));
        
        return view('mitra/edit_vitamin')->with('vitamins', $vitamins)->with('sikluses', $sikluses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vitamin_id)
    {
        $this->validate(request(),[
            'siklus_id' => 'required',
            'jenis_vitamin' => 'required',
            'jumlah_vitamin' => 'required',
            'tanggal' => 'required',
            ]);

        $data = request()->all();

        $vitamin = Vitamin::find($vitamin_id);
        $vitamin->siklus_id = $data['siklus_id'];
        $vitamin->jenis_vitamin = $data['jenis_vitamin'];
        $vitamin->jumlah_vitamin = $data['jumlah_vitamin'];
        $vitamin->tanggal = $data['tanggal'];

        $vitamin->save();

        session()->flash('success', 'Data Berhasil Diubah');

        return redirect('/mitra/vitamin')->with('status', 'Data vitamin berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($vitamin_id)
    {
        $vitamin = Vitamin::find($vitamin_id);

        $vitamin->delete();

        session()->flash('success', 'Data Berhasil Dihapus');

        return redirect('/mitra/vitamin');
    }
}
