<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use App\Models\Pjub;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\DataTables\Admin\MitraDataTable;
use App\Exports\Admin\MitraExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MitraDataTable $dataTable)
    {
        
        // $mitras =array(array('id'=>1,'nama'=>'om aris'),array('id'=>2,'nama'=>'aris'));

        $mitras = Mitra::all();
        $pjubs = Pjub::all();

        // var_dump($mitras);
        // die;

        return $dataTable->render('admin/mitra',['mitras'=>$mitras],['pjubs'=>$pjubs]);
    
        return view('admin/mitra',['mitra'=>$mitra],['pjub'=>$pjub]);
    }

    public function export_excel()
    {
        return Excel::download(new MitraExport, 'Mitra.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function exportPDF() 
    // {
       
    //     $mitra = Mitra::all();
  
    //     $pdf = PDF::loadView('admin/mitra', ['mitra' => $mitra]);
        
    //     return $pdf->download('mitra.pdf');
        
    // }


    public function create()
    {
        //
        // $pjubs = Pjub::all();
        return view('admin/tambah_mitra')->with('pjubs', Pjub::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // DB::table('mitra')->insert([
        
            $this->validate(request(),[
                'pjub_id' => 'required',
                'nama' => 'required',
                'nik' => 'required|max:16',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required|min:11|max:13',
                'email' => 'required',
            ]);
                
        // Mitra::create($request->all());
        // return redirect('/admin/mitra')->with('status', 'Data mitra berhasil ditambahkan');
    
        $data = request()->all();

        $mitra = new Mitra();
        $mitra->pjub_id = $data['pjub_id'];
        $mitra->nama = $data['nama'];
        $mitra->nik = $data['nik'];
        $mitra->tempat_lahir = $data['tempat_lahir'];
        $mitra->tanggal_lahir = $data['tanggal_lahir'];
        $mitra->alamat = $data['alamat'];
        $mitra->no_hp = $data['no_hp'];
        $mitra->email = $data['email'];

        $mitra->save();

        session()->flash('success', 'Data Berhasil Ditambah');

        return redirect('/admin/mitra')->with('status', 'Data mitra berhasil ditambahkan');
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
    public function edit($mitra_id)
    {
        //
        $mitras = Mitra::find($mitra_id);        
        $pjubs = Pjub::all();
               
        // $pjubs = array((object)array('id'=>1,'nama'=>'om aris'),(object)array('id'=>2,'nama'=>'aris'),(object)array('id'=>3,'nama'=>'abcd'));

        return view('admin/edit_mitra')->with('mitras', $mitras)->with('pjubs', $pjubs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $mitra_id)
    {
        //
        $this->validate(request(),[
            'pjub_id' => 'required',
            'nama' => 'required',
            'nik' => 'required|max:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|min:11|max:13',
            'email' => 'required',
        ]);

        $data = request()->all();

        $mitra = Mitra::Find($mitra_id);
        $mitra->pjub_id = $data['pjub_id'];
        $mitra->nama = $data['nama'];
        $mitra->nik = $data['nik'];
        $mitra->tempat_lahir = $data['tempat_lahir'];
        $mitra->tanggal_lahir = $data['tanggal_lahir'];
        $mitra->alamat = $data['alamat'];
        $mitra->no_hp = $data['no_hp'];
        $mitra->email = $data['email'];

        $mitra->save();

        session()->flash('success', 'Data Berhasil Diubah');

        return redirect('/admin/mitra')->with('status', 'Data farm berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($mitra_id)
    {
        //
        $mitra = Mitra::find($mitra_id);

        $mitra->delete();

        session()->flash('success', 'Data Berhasil Dihapus');

        return redirect('/admin/mitra');
    }
}
