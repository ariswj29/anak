<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $farms = \DB::select(\DB::raw("
        SELECT ROW_NUMBER
            ( ) OVER ( ORDER BY farm ASC ) AS NO,
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
            LEFT JOIN pjub ON pjub.pjub_id = mitra.pjub_id 
        "));
        

        return view('admin/farm')->with('farms', $farms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin/tambah_farm')->with('mitras', mitra::all());
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

        return redirect('/admin/farm')->with('status', 'Data farm berhasil ditambahkan');
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
        $mitras = Mitra::all();

        return view('admin/edit_farm')->with('farms', $farms)->with('mitras', $mitras);
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

        return redirect('/admin/farm');
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

        return redirect('/admin/farm');
    }
}
