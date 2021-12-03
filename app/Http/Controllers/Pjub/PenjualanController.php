<?php

namespace App\Http\Controllers\Pjub;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use File;
use Auth;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sikluses = Siklus::all();
        $recording = \DB::select(\DB::raw("
        SELECT 
            ROW_NUMBER ( ) OVER ( ORDER BY penjualan.tanggal ASC ) AS NO,
            penjualan.penjualan_id,
            penjualan.jumlah,
            penjualan.bobot_jual,
            siklus.nama_siklus,
            siklus.siklus_id,
            farm.nama_farm,
            mitra.nama,
            penjualan.jumlah_nominal,
            penjualan.tanggal, 
            penjualan.foto 
        FROM
            penjualan
            JOIN siklus ON penjualan.siklus_id = siklus.siklus_id
            JOIN farm ON siklus.farm_id = farm.farm_id
            JOIN mitra ON farm.mitra_id = mitra.mitra_id 
            LEFT JOIN pjub ON pjub.pjub_id = mitra.pjub_id
        WHERE
            pjub.email = '".Auth::user()->email."'
            and penjualan.deleted_at IS Null"));

        return view('pjub/penjualan')->with(array('recording'=> $recording, 'sikluses'=> $sikluses));
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
            farm.nama_farm,
            mitra.nama 
        FROM
            siklus
            JOIN farm ON siklus.farm_id = farm.farm_id
            JOIN mitra ON farm.mitra_id = mitra.mitra_id 
            JOIN pjub ON pjub.pjub_id = mitra.pjub_id
        WHERE
            pjub.email = '".Auth::user()->email."' "));
        // var_dump($sikluses);
        // die;    
        return view('pjub/tambah_penjualan')->with('sikluses', $sikluses);
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
            'jumlah' => 'required',
            'bobot_jual' => 'required',
            'jumlah_nominal' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png',
            // 'created_at' => '',
            // 'updated_at' => '',  
            ]);

        $data = request()->all();

        $penjualan = new Penjualan();
        $penjualan->siklus_id = $data['siklus_id'];
        $penjualan->tanggal = $data['tanggal'];
        $penjualan->jumlah = $data['jumlah'];
        $penjualan->bobot_jual = $data['bobot_jual'];
        $penjualan->jumlah_nominal = $data['jumlah_nominal'];
        $penjualan->foto = $data['foto'];
        // $penjualan->created_at = $data['created_at'];
        // $penjualan->updated_at = $data['updated_at'];

        $foto = $request->foto;
        $namafile = time().'.'.$foto->getClientOriginalExtension();
        $foto->move('images/', $namafile);
        $penjualan->foto = $namafile;
        $penjualan->save();

        session()->flash('success', 'Data Berhasil Ditambah');

        return redirect('/pjub/penjualan')->with('status', 'Data Penjualan berhasil ditambahkan');
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
    public function edit($penjualan_id)
    {
        $penjualans = Penjualan::find($penjualan_id);
        $sikluses = \DB::select(\DB::raw("
        SELECT
            siklus.nama_siklus,
            siklus.siklus_id,
            farm.nama_farm,
            mitra.nama 
        FROM
            penjualan
            JOIN siklus on penjualan.siklus_id = siklus.siklus_id
            JOIN farm ON siklus.farm_id = farm.farm_id
            JOIN mitra ON farm.mitra_id = mitra.mitra_id 
            JOIN pjub ON pjub.pjub_id = mitra.pjub_id
        WHERE
            penjualan.penjualan_id = $penjualan_id "));
        
        return view('pjub/edit_penjualan')->with('penjualans', $penjualans)->with('sikluses', $sikluses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $penjualan_id)
    {
        $this->validate(request(),[
            'siklus_id' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required',
            'bobot_jual' => 'required',
            'jumlah_nominal' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png',
            // 'created_at' => '',
            // 'updated_at' => '',  
            ]);

        $data = request()->all();

        $penjualan = Penjualan::find($penjualan_id);
        $penjualan->siklus_id = $data['siklus_id'];
        $penjualan->tanggal = $data['tanggal'];
        $penjualan->jumlah = $data['jumlah'];
        $penjualan->bobot_jual = $data['bobot_jual'];
        $penjualan->jumlah_nominal = $data['jumlah_nominal'];
        $penjualan->foto = $data['foto'];
        // $penjualan->created_at = $data['created_at'];
        // $penjualan->updated_at = $data['updated_at'];

        $foto = $request->foto;
        $namafile = time().'.'.$foto->getClientOriginalExtension();
        $foto->move('images/', $namafile);
        $penjualan->foto = $namafile;
        $penjualan->update();

        session()->flash('success', 'Data Berhasil Diubah');

        return redirect('/pjub/penjualan')->with('status', 'Data penjualan berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($penjualan_id)
    {
        $penjualan = penjualan::find($penjualan_id);

        $penjualan->delete();

        session()->flash('success', 'Data Berhasil Dihapus');

        return redirect('/pjub/penjualan');
    }
}
