<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Berat;
use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\DataTables\Mitra\BeratDataTable;
use App\Exports\Mitra\BeratExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class BeratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BeratDataTable $dataTable)
    {
        // $recording = \DB::select(\DB::raw("
        // SELECT 
        //     ROW_NUMBER ( ) OVER ( ORDER BY berat.tanggal DESC ) AS NO,
        //     berat.berat_id,
        //     siklus.nama_siklus,
        //     berat.rata_rata_berat,
        //     berat.tanggal,
        //     farm.nama_farm
        // FROM
        //     berat
        //     JOIN siklus ON berat.siklus_id = siklus.siklus_id
        //     JOIN farm ON siklus.farm_id = farm.farm_id
        //     JOIN mitra ON farm.mitra_id = mitra.mitra_id
        // WHERE
        //     mitra.email = '".Auth::user()->email."'
        //     AND berat.deleted_at IS NULL"));

        // $berats = Berat::all();
        // $sikluses = Siklus::all();

        // return view('mitra/berat')->with(array('berats'=> $berats, 'sikluses'=> $sikluses, 'recording'=> $recording));

        return $dataTable->render('mitra/berat');
    
        return view('mitra/berat',['berat'=>$berat]);
    }

    public function export_excel()
    {
        return Excel::download(new BeratExport, 'Berat.xlsx');
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
            berat
            JOIN siklus ON berat.siklus_id = siklus.siklus_id
        WHERE
            berat.siklus_id = 1 "));
        return view('mitra/tambah_berat')->with('sikluses', $sikluses);
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

        return redirect('/mitra/berat')->with('status', 'Data berat berhasil ditambahkan');
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
            siklus.siklus_id 
        FROM
            berat
            JOIN siklus ON berat.siklus_id = siklus.siklus_id
        WHERE
            berat.siklus_id = 1 "));
        
        return view('mitra/edit_berat')->with('berats', $berats)->with('sikluses', $sikluses);
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

        return redirect('/mitra/berat')->with('status', 'Data berat berhasil ditambahkan');
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

        return redirect('/mitra/berat');
    }
}
