<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pjub;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class PjubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $pjubs =array(array('id'=>1,'nama'=>'om aris'),array('id'=>2,'nama'=>'aris'));

        $pjubs = Pjub::all();
        return view('admin/pjub')->with('pjubs', $pjubs);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin/tambah_pjub');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // DB::table('pjub')->insert([
        
            $this->validate(request(),[
                'nama' => 'required',
                'nik' => 'required|max:16',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required|min:11|max:13',
                'email' => 'required',
            ]);
                
        // pjub::create($request->all());
        // return redirect('/admin/pjub')->with('status', 'Data pjub berhasil ditambahkan');
    
        $data = request()->all();

        $pjub = new Pjub();
        $pjub->nama = $data['nama'];
        $pjub->nik = $data['nik'];
        $pjub->tempat_lahir = $data['tempat_lahir'];
        $pjub->tanggal_lahir = $data['tanggal_lahir'];
        $pjub->alamat = $data['alamat'];
        $pjub->no_hp = $data['no_hp'];
        $pjub->email = $data['email'];

        $pjub->save();

        session()->flash('success', 'Data Berhasil Ditambah');

        return redirect('/admin/pjub')->with('status', 'Data pjub berhasil ditambahkan');
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
        $pjubs = Pjub::all();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($pjub_id)
    {
        //
        $pjubs = Pjub::find($pjub_id);
        
        return view('admin/edit_pjub')->with('pjubs', $pjubs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pjub_id)
    {
        //
        $this->validate(request(),[
            'nama' => 'required',
            'nik' => 'required|max:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|min:11|max:13',
            'email' => 'required',
        ]);

        $data = request()->all();

        $pjub = Pjub::Find($pjub_id);
        $pjub->nama = $data['nama'];
        $pjub->nik = $data['nik'];
        $pjub->tempat_lahir = $data['tempat_lahir'];
        $pjub->tanggal_lahir = $data['tanggal_lahir'];
        $pjub->alamat = $data['alamat'];
        $pjub->no_hp = $data['no_hp'];
        $pjub->email = $data['email'];

        $pjub->save();

        session()->flash('success', 'Data Berhasil Diubah');

        return redirect('/admin/pjub')->with('status', 'Data farm berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pjub_id)
    {
        //
        $pjub = Pjub::find($pjub_id);

        $pjub->delete();

        session()->flash('success', 'Data Berhasil Dihapus');

        return redirect('/admin/pjub');
    }
}
