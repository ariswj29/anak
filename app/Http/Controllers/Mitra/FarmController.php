<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class FarmController extends Controller
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
        row_number() over(ORDER BY farm ASC) AS no,
        farm.farm_id,
        farm.nama_farm,
        farm.alamat_farm,
        farm.mata_uang,
        farm.satuan_berat,
        farm.kapasitas_kandang_doc,
        farm.kapasitas_kandang_grower,
        farm.kapasitas_rak_telur,
        mitra.nama
    FROM
        farm
        JOIN mitra ON farm.mitra_id = mitra.mitra_id 
    WHERE
	    mitra.email = '".Auth::user()->email."'"));

        // $farms = Farm::all();
        // $mitras = mitra::all();

        return view('mitra/farm', ['recording'=>$recording]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mitras = \DB::select(\DB::raw("
        SELECT
            mitra.nama,
            mitra.mitra_id 
        FROM
            mitra
        WHERE
            mitra.email = '".Auth::user()->email."' "));

        return view('mitra/tambah_farm')->with('mitras', $mitras);
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
            'mitra_id' => 'required',
            'nama_farm' => 'required',
            'alamat_farm' => 'required',
            'mata_uang' => 'required',
            'satuan_berat' => 'required',
            'kapasitas_rak_telur' => 'required',
            'kapasitas_kandang_doc' => 'required',
            'kapasitas_kandang_grower' => 'required',
        ]);

        $data = request()->all();

        $farm = new Farm();
        $farm->mitra_id = $data['mitra_id'];
        $farm->nama_farm = $data['nama_farm'];
        $farm->alamat_farm = $data['alamat_farm'];
        $farm->mata_uang = $data['mata_uang'];
        $farm->satuan_berat = $data['satuan_berat'];
        $farm->kapasitas_rak_telur = $data['kapasitas_rak_telur'];
        $farm->kapasitas_kandang_doc = $data['kapasitas_kandang_doc'];
        $farm->kapasitas_kandang_grower = $data['kapasitas_kandang_grower'];

        $farm->save();

        session()->flash('success', 'Data Berhasil Ditambah');

        return redirect('/mitra/farm')->with('status', 'Data farm berhasil ditambahkan');
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
    public function edit($farm_id)
    {
        //
        $farms = Farm::find($farm_id);
        // $mitras = Mitra::all();
        $mitras = \DB::select(\DB::raw("
        SELECT 
            mitra.nama, 
            mitra.mitra_id 
        FROM 
            farm 
            JOIN mitra on farm.mitra_id =  mitra.mitra_id 
        WHERE 
            farm.farm_id = 1 "));

        return view('mitra/edit_farm')->with('farms', $farms)->with('mitras', $mitras);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $farm_id)
    {
        //
        $this->validate(request(),[
            'mitra_id' => 'required',
            'nama_farm' => 'required',
            'alamat_farm' => 'required',
            // 'no_hp' => 'required',
            // 'email' => 'required',
            'mata_uang' => 'required',
            'satuan_berat' => 'required',
            'kapasitas_rak_telur' => 'required',
            'kapasitas_kandang_doc' => 'required',
            'kapasitas_kandang_grower' => 'required',
        ]);

        $data = request()->all();

        $farm = Farm::Find($farm_id);
        $farm->mitra_id = $data['mitra_id'];
        $farm->nama_farm = $data['nama_farm'];
        $farm->alamat_farm = $data['alamat_farm'];
        // $farm->no_hp = $data['no_hp'];
        // $farm->email = $data['email'];
        $farm->mata_uang = $data['mata_uang'];
        $farm->satuan_berat = $data['satuan_berat'];
        $farm->kapasitas_rak_telur = $data['kapasitas_rak_telur'];
        $farm->kapasitas_kandang_doc = $data['kapasitas_kandang_doc'];
        $farm->kapasitas_kandang_grower = $data['kapasitas_kandang_grower'];

        $farm->save();

        session()->flash('success', 'Data Berhasil Diubah');

        return redirect('/mitra/farm');
        // ->with('status', 'Data farm berhasil diubah');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($farm_id)
    {
        //
        $farm = Farm::find($farm_id);

        $farm->delete();

        session()->flash('success', 'Data Berhasil Dihapus');

        return redirect('/mitra/farm');
    }
}
