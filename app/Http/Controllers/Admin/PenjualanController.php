<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use File;
use App\DataTables\PenjualanDataTable;
use App\Exports\PenjualanExport;
use Maatwebsite\Excel\Facades\Excel;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PenjualanDataTable $dataTable)
    {
        // $penjualans = Penjualan::all();
        // $sikluses = Siklus::all();

        // return view('admin/penjualan')->with(array('penjualans'=> $penjualans, 'sikluses'=> $sikluses));
        return $dataTable->render('admin/penjualan');
    
        return view('admin/penjualan',['penjualan'=>$penjualan]);
    }

    public function export_excel()
    {
        return Excel::download(new PenjualanExport, 'Penjualan.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penjualans = Penjualan::all();
        return view('admin/tambah_penjualan')->with('penjualans', $penjualans)->with('sikluses', siklus::all());
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

        return redirect('/admin/penjualan')->with('status', 'Data Penjualan berhasil ditambahkan');
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
        $sikluses = Siklus::all();
        
        return view('admin/edit_penjualan')->with('penjualans', $penjualans)->with('sikluses', $sikluses);
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

        return redirect('/admin/penjualan')->with('status', 'Data penjualan berhasil ditambahkan');
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

        return redirect('/admin/penjualan');
    }
}
