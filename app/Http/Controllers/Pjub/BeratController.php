<?php

namespace App\Http\Controllers\Pjub;

use App\Http\Controllers\Controller;
use App\Models\Berat;
use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class BeratController extends Controller
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
            ROW_NUMBER ( ) OVER ( ORDER BY berat.tanggal ASC ) AS NO,
            berat.berat_id,
            siklus.nama_siklus,
            farm.nama_farm,
            mitra.nama,
            berat.rata_rata_berat,
            berat.tanggal 
        FROM
            berat
            JOIN siklus ON berat.siklus_id = siklus.siklus_id
            JOIN farm ON siklus.farm_id = farm.farm_id
            JOIN mitra ON farm.mitra_id = mitra.mitra_id
            LEFT JOIN pjub ON pjub.pjub_id = mitra.pjub_id
        WHERE
            pjub.email = '".Auth::user()->email."'
            and berat.deleted_at IS Null"));

        $berats = Berat::all();
        $sikluses = Siklus::all();

        return view('pjub/berat')->with(array('berats'=> $berats, 'sikluses'=> $sikluses, 'recording'=> $recording));
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
        return view('pjub/tambah_berat')->with('sikluses', $sikluses);
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
            'rata_rata_berat' => 'required',
            'tanggal' => 'required',
            ]);

        $data = request()->all();

        $berat = new Berat();
        $berat->siklus_id = $data['siklus_id'];
        $berat->rata_rata_berat = $data['rata_rata_berat'];
        $berat->tanggal = $data['tanggal'];

        $berat->save();

        session()->flash('success', 'Data Berhasil Ditambah');

        return redirect('/pjub/berat')->with('status', 'Data berat berhasil ditambahkan');
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
    public function edit($berat_id)
    {
        $berats = Berat::find($berat_id);
        $sikluses = \DB::select(\DB::raw("
        SELECT
            siklus.nama_siklus,
            siklus.siklus_id,
            farm.nama_farm 
        FROM
            berat
            JOIN siklus ON berat.siklus_id = siklus.siklus_id
            JOIN farm ON siklus.farm_id = farm.farm_id
        WHERE
            berat.berat_id = $berat_id "));
        
        return view('pjub/edit_berat')->with('berats', $berats)->with('sikluses', $sikluses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $berat_id)
    {
        $this->validate(request(),[
            'siklus_id' => 'required',
            'rata_rata_berat' => 'required',
            'tanggal' => 'required',
            ]);

        $data = request()->all();

        $berat = Berat::find($berat_id);
        $berat->siklus_id = $data['siklus_id'];
        $berat->rata_rata_berat = $data['rata_rata_berat'];
        $berat->tanggal = $data['tanggal'];

        $berat->save();

        session()->flash('success', 'Data Berhasil Diubah');

        return redirect('/pjub/berat')->with('status', 'Data berat berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($berat_id)
    {
        $berat = Berat::find($berat_id);

        $berat->delete();

        session()->flash('success', 'Data Berhasil Dihapus');

        return redirect('/pjub/berat');
    }
}
