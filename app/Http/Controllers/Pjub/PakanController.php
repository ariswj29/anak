<?php

namespace App\Http\Controllers\Pjub;

use App\Http\Controllers\Controller;
use App\Models\Pakan;
use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class PakanController extends Controller
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
            row_number() over(ORDER BY pakan.tanggal ASC) AS no,
            pakan.pakan_id,
            siklus.nama_siklus,
            farm.nama_farm,
            mitra.nama,
            pakan.tanggal,
            pakan.jenis_pakan,
            pakan.jumlah_pakan,
            pakan.pakan_digunakan
        FROM
        pakan
            JOIN siklus on pakan.siklus_id =  siklus.siklus_id
            LEFT JOIN farm ON farm.farm_id = siklus.farm_id
            JOIN mitra ON farm.mitra_id = mitra.mitra_id 
            LEFT JOIN pjub ON pjub.pjub_id = mitra.pjub_id
        WHERE
            pjub.email = '".Auth::user()->email."'"));
        $pakans = Pakan::all();
        $sikluses = Siklus::all();

        return view('pjub/pakan')->with(array('pakans'=> $pakans, 'recording'=> $recording, 'sikluses'=> $sikluses));
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
            pakan
            JOIN siklus ON pakan.siklus_id = siklus.siklus_id
            JOIN farm ON pakan.farm_id = farm.farm_id
        WHERE
            pakan.siklus_id = 1 "));
        return view('mitra/tambah_pakan')->with('sikluses', $sikluses);
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
            'jenis_pakan' => 'required',
            'jumlah_pakan' => 'required',
            'pakan_digunakan' => '',
            'tanggal' => 'required',
            ]);

        $data = request()->all();

        $pakan = new Pakan();
        $pakan->siklus_id = $data['siklus_id'];
        $pakan->jenis_pakan = $data['jenis_pakan'];
        $pakan->jumlah_pakan = $data['jumlah_pakan'];
        $pakan->pakan_digunakan = $data['pakan_digunakan'];
        $pakan->tanggal = $data['tanggal'];

        $pakan->save();

        session()->flash('success', 'Data Berhasil Ditambah');

        return redirect('/mitra/pakan')->with('status', 'Data pakan berhasil ditambahkan');
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
    public function edit($pakan_id)
    {
        $pakans = Pakan::find($pakan_id);
        $sikluses = \DB::select(\DB::raw("
        SELECT
            siklus.nama_siklus,
            siklus.siklus_id 
        FROM
            pakan
            JOIN siklus ON pakan.siklus_id = siklus.siklus_id
        WHERE
            pakan.siklus_id = 1 "));
        
        return view('mitra/edit_pakan')->with('pakans', $pakans)->with('sikluses', $sikluses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pakan_id)
    {
        $this->validate(request(),[
            'siklus_id' => 'required',
            'jenis_pakan' => 'required',
            'jumlah_pakan' => 'required',
            'pakan_digunakan' => '',
            'tanggal' => 'required',
            ]);

        $data = request()->all();

        $pakan = Pakan::find($pakan_id);
        $pakan->siklus_id = $data['siklus_id'];
        $pakan->jenis_pakan = $data['jenis_pakan'];
        $pakan->jumlah_pakan = $data['jumlah_pakan'];
        $pakan->pakan_digunakan = $data['pakan_digunakan'];
        $pakan->tanggal = $data['tanggal'];

        $pakan->save();

        session()->flash('success', 'Data Berhasil Diubah');

        return redirect('/mitra/pakan')->with('status', 'Data pakan berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pakan_id)
    {
        $pakan = Pakan::find($pakan_id);

        $pakan->delete();

        session()->flash('success', 'Data Berhasil Dihapus');

        return redirect('/mitra/pakan');
    }
}
