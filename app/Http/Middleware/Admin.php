<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->hak_akses == 'administrator') {
            return $next($request);
            return redirect('home')->with(session()->flash('success', 'Data Berhasil Ditambah'));
        }elseif (Auth::check() && Auth::user()->hak_akses == 'mitra'){
            return redirect('mitra/index')->with(session()->flash('success', 'Anda Berhasil Login'));
        }elseif (Auth::check() && Auth::user()->hak_akses == 'pjub') {
             return redirect('pjub/index')->with(session()->flash('success', 'Anda Berhasil Login'));
        } 
    }
}
