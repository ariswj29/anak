<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\Pjub;
use App\Models\Mitra;
use App\Models\Farm;
use App\Models\Siklus;
use App\Models\User;
use Auth;

class HomeController extends Controller
{   
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pjubs = Pjub::all();
        $mitras = Mitra::all();
        $farms = Farm::all();
        $sikluses = Siklus::all();
        return view('home')->with('pjubs', $pjubs)->with('mitras', $mitras)->with('farms', $farms)->with('sikluses', $sikluses);
    }

    public function profil()
    {
        $user = Auth::user();
        // $pjubs = Pjub::all();
        // echo $user->email;
        // die;

        $profil = User::where('email', $user->email)->first();
        $pjub = Pjub::where('email', $user->email)->first();
        $mitra = Mitra::where('email', $user->email)->first();
        return view('profile')->with('profil', $profil)->with('pjub', $pjub)->with('mitra', $mitra);
    }

    public function profile(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        session()->flash('success', 'Password Berhasil Diubah');
        session()->flash('danger', 'Password Yang Anda Masukan Salah!');

        return redirect('/profile');
    }

    public function show()
    {
    //   // Jumlah Farm Di Dasbor
    // $pjub = Pjub::where('pjub_id',$pjub_id)->first();
    // $pjub = Pjub::where('pjub_id',$pjub_id)->first();
    //   return view ('home', compact('farms'));
    }
}

