<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kas;
use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kas = kas::all();
        $sikluses = Siklus::all();
        
        return view('admin/kas')->with(array('kas'=> $kas, 'sikluses'=> $sikluses));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/tambah_kas')->with('sikluses', siklus::all());
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
            'kas_id' => 'required',
            'siklus_id' => 'required',
            'tanggal' => 'required',
            'jenis_transaksi' => 'required',
            'kategori' => 'required',
            'nominal' => 'required',
            'catatan' => 'required',
            ]);

        $data = request()->all();

        $kas = new kas();
        $kas->kas_id = $data['kas_id'];
        $kas->siklus_id = $data['siklus_id'];
        $kas->tanggal = $data['tanggal'];
        $kas->jenis_transaksi = $data['jenis_transaksi'];
        $kas->kategori = $data['kategori'];
        $kas->nominal = $data['nominal'];
        $kas->catatan = $data['catatan'];

        $kas->save();

        session()->flash('success', 'Data Berhasil Ditambah');

        return redirect('/admin/kas')->with('status', 'Data kas berhasil ditambahkan');
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
    public function edit($kas_id)
    {
        $kas = Kas::find($kas_id);
        $sikluses = Siklus::all();

        return view('admin/edit_kas')->with('kas', $kas)->with('sikluses', $sikluses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kas_id)
    {
        $this->validate(request(),[
            'kas_id' => 'required',
            'siklus_id' => 'required',
            'tanggal' => 'required',
            'jenis_transaksi' => 'required',
            'kategori' => 'required',
            'nominal' => 'required',
            'catatan' => 'required',
            ]);

        $data = request()->all();

        $kas = Kas::find($kas_id);
        $kas->kas_id = $data['kas_id'];
        $kas->siklus_id = $data['siklus_id'];
        $kas->tanggal = $data['tanggal'];
        $kas->jenis_transaksi = $data['jenis_transaksi'];
        $kas->kategori = $data['kategori'];
        $kas->nominal = $data['nominal'];
        $kas->catatan = $data['catatan'];

        $kas->save();

        session()->flash('success', 'Data Berhasil Diubah');

        return redirect('/admin/kas')->with('status', 'Data kas berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
