<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Minum;
use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\DataTables\MinumDataTable;
use App\Exports\MinumExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\View\View\filterColumn;

class MinumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MinumDataTable $dataTable)
    {
        // $minums = Minum::all();
        // $sikluses = Siklus::all();

        // return view('admin/minum')->with(array('minums'=> $minums, 'sikluses'=> $sikluses));

        return $dataTable->render('admin/minum');
        // ->filterColumn('tanggal', function ($query, $keyword) {
        //     $query->whereRaw("DATE_FORMAT(tanggal,'%d/%m/%Y') like ?", ["%$keyword%"]);
        // });
    
        return view('admin/minum',['minum'=>$minum]);
    }

    public function export_excel()
    {
        return Excel::download(new MinumExport, 'Minum.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/tambah_minum')->with('sikluses', siklus::all());;
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
            'jumlah_minum' => 'required',
            'tanggal' => 'required',
            ]);

        $data = request()->all();

        $minum = new Minum();
        $minum->siklus_id = $data['siklus_id'];
        $minum->jumlah_minum = $data['jumlah_minum'];
        $minum->tanggal = $data['tanggal'];

        $minum->save();

        session()->flash('success', 'Data Berhasil Ditambah');

        return redirect('/admin/minum')->with('status', 'Data minum berhasil ditambahkan');
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
    public function edit($minum_id)
    {
        $minums = Minum::find($minum_id);
        $sikluses = Siklus::all();
        
        return view('admin/edit_minum')->with('minums', $minums)->with('sikluses', $sikluses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $minum_id)
    {
        $this->validate(request(),[
            'siklus_id' => 'required',
            'jumlah_minum' => 'required',
            'tanggal' => 'required',
            ]);

        $data = request()->all();

        $minum = Minum::find($minum_id);
        $minum->siklus_id = $data['siklus_id'];
        $minum->jumlah_minum = $data['jumlah_minum'];
        $minum->tanggal = $data['tanggal'];

        $minum->save();

        session()->flash('success', 'Data Berhasil Diubah');

        return redirect('/admin/minum')->with('status', 'Data minum berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($minum_id)
    {
        $minum = Minum::find($minum_id);

        $minum->delete();

        session()->flash('success', 'Data Berhasil Dihapus');

        return redirect('/admin/minum');
    }
}
