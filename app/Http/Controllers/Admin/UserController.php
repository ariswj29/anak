<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use App\DataTables\UserDataTable;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {
     return $dataTable->render('admin/user');
    
    return view('admin/user',['user'=>$user]);
    }

    public function export_excel()
	{
		return Excel::download(new UserExport, 'User.xlsx');
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
        return view('admin/tambah_user');
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
                'name' => 'required',
                'hak_akses' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);
                
        // Mitra::create($request->all());
        // return redirect('/admin/mitra')->with('status', 'Data mitra berhasil ditambahkan');
    
        $data = request()->all();

        $user = new user();
        $user->name = $data['name'];
        $user->hak_akses = $data['hak_akses'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);

        $user->save();

        session()->flash('success', 'Data Berhasil Ditambah');

        return redirect('/admin/user')->with('status', 'Data user berhasil ditambahkan');
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
    public function edit($id)
    {
        //
        $users = user::find($id);
               
        // $pjubs = array((object)array('id'=>1,'nama'=>'om aris'),(object)array('id'=>2,'nama'=>'aris'),(object)array('id'=>3,'nama'=>'abcd'));

        return view('admin/edit_user')->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate(request(),[
            'name' => 'required',
            'hak_akses' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = request()->all();

        $user = User::Find($id);
        $user->name = $data['name'];
        $user->hak_akses = $data['hak_akses'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);

        $user->save();

        session()->flash('success', 'Data Berhasil Diubah');

        return redirect('/admin/user')->with('status', 'Data farm berhasil diubah');
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
        $user = User::find($id);

        $user->delete();

        session()->flash('success', 'Data Berhasil Dihapus');

        return redirect('/admin/user');
    }
}
