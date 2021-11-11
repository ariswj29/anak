<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vitamin;
use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class VitaminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vitamins = Vitamin::all();
        $sikluses = Siklus::all();

        return view('admin/vitamin')->with(array('vitamins'=> $vitamins, 'sikluses'=> $sikluses));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/tambah_vitamin')->with('sikluses', siklus::all());
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

        return redirect('/admin/vitamin')->with('status', 'Data vitamin berhasil ditambahkan');
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
        $sikluses = Siklus::all();
        
        return view('admin/edit_vitamin')->with('vitamins', $vitamins)->with('sikluses', $sikluses);
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

        return redirect('/admin/vitamin')->with('status', 'Data vitamin berhasil ditambahkan');
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

        return redirect('/admin/vitamin');
    }
}
