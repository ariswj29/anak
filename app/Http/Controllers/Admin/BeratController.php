<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berat;
use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class BeratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berats = Berat::all();
        $sikluses = Siklus::all();

        return view('admin/berat')->with(array('berats'=> $berats, 'sikluses'=> $sikluses));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/tambah_berat')->with('sikluses', siklus::all());
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

        return redirect('/admin/berat')->with('status', 'Data berat berhasil ditambahkan');
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
        $sikluses = Siklus::all();
        
        return view('admin/edit_berat')->with('berats', $berats)->with('sikluses', $sikluses);
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

        return redirect('/admin/berat')->with('status', 'Data berat berhasil ditambahkan');
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

        return redirect('/admin/berat');
    }
}
