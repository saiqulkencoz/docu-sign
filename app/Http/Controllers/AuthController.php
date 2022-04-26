<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }
    public function postlogin(Request $request){
        // return dd($request->all());
        if(Auth::attempt($request->only('nip','password'))){
            if(Auth()->user()->role=="root"){
                return redirect('/super/instansi');
            }
            else if(Auth()->user()->role=="kepala dinas"){
                return redirect('/kadis/dokumen');
            }
            else{
                return redirect('/admin/pengajuan');
            }
        }
        return redirect('/login');
    }
    public function logout (Request $request){
        Auth::logout();
        return redirect('/login');
    }
}
