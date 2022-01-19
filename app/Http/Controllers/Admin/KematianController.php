<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kematian;
use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\DataTables\Admin\KematianDataTable;
use App\Exports\Admin\KematianExport;
use Maatwebsite\Excel\Facades\Excel;

class KematianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KematianDataTable $dataTable)
    {
        // $kematians = Kematian::all();
        // $sikluses = Siklus::all();

        // return view('admin/kematian')->with(array('kematians'=> $kematians, 'sikluses'=> $sikluses));

        return $dataTable->render('admin/kematian');
    
        return view('admin/kematian',['kematian'=>$kematian]);
    }

    public function export_excel()
    {
        return Excel::download(new KematianExport, 'Kematian.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/tambah_kematian')->with('sikluses', siklus::all());
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
            'penyebab' => 'required',
            'jumlah_kematian' => 'required',
            ]);

        $data = request()->all();

        $kematian = new Kematian();
        $kematian->siklus_id = $data['siklus_id'];
        $kematian->tanggal = $data['tanggal'];
        $kematian->penyebab = $data['penyebab'];
        $kematian->jumlah_kematian = $data['jumlah_kematian'];

        $kematian->save();

        session()->flash('success', 'Data Berhasil Ditambah');

        return redirect('/admin/kematian')->with('status', 'Data kematian berhasil ditambahkan');
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
    public function edit($kematian_id)
    {
        $kematians = Kematian::find($kematian_id);
        $sikluses = Siklus::all();
        
        return view('admin/edit_kematian')->with('kematians', $kematians)->with('sikluses', $sikluses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kematian_id)
    {
        $this->validate(request(),[
            'siklus_id' => 'required',
            'tanggal' => 'required',
            'penyebab' => 'required',
            'jumlah_kematian' => 'required',
            ]);

        $data = request()->all();

        $kematian = Kematian::find($kematian_id);
        $kematian->siklus_id = $data['siklus_id'];
        $kematian->tanggal = $data['tanggal'];
        $kematian->penyebab = $data['penyebab'];
        $kematian->jumlah_kematian = $data['jumlah_kematian'];

        $kematian->save();

        session()->flash('success', 'Data Berhasil Diubah');

        return redirect('/admin/kematian')->with('status', 'Data kematian berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kematian_id)
    {
        $kematian = Kematian::find($kematian_id);

        $kematian->delete();

        session()->flash('success', 'Data Berhasil Dihapus');

        return redirect('/admin/kematian');
    }
}
