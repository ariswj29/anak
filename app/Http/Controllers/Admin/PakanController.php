<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pakan;
use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class PakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pakans = Pakan::all();
        $sikluses = Siklus::all();

        return view('admin/pakan')->with(array('pakans'=> $pakans, 'sikluses'=> $sikluses));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin/tambah_pakan')->with('sikluses', siklus::all());
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

        return redirect('/admin/pakan')->with('status', 'Data pakan berhasil ditambahkan');
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
        $sikluses = Siklus::all();
        
        return view('admin/edit_pakan')->with('pakans', $pakans)->with('sikluses', $sikluses);
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

        return redirect('/admin/pakan')->with('status', 'Data pakan berhasil ditambahkan');
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

        return redirect('/admin/pakan');
    }
}
