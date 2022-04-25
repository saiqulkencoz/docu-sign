<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instansi;
use App\User;

class SuperadminController extends Controller
{
    public function instansi_index(){
        $instansi = Instansi::all();
        return view('master_super.dinas_index',['instansi' => $instansi]);
    }

    public function create(Request $request){
        $instansi = Instansi::create($request->all());
        return redirect()->back()->with('Sukses','Data Berhasil Diinput');
    }

    public function update_index($id){
        $instansi = Instansi::find($id);
        return view('master_super.dinas_update',['instansi' => $instansi]);
    }

    public function update(Request $request,$id){
        $instansi = Instansi::find($id);
        $instansi->update($request->all());
        return redirect('/super/instansi')->with('Sukses','Data Berhasil Di Update');
    }

    public function delete($id){
        $instansi = Instansi::find($id);
        $instansi->delete($instansi);
        return redirect()->back()->with('Sukses','Data Berhasil Dihapus');
    }

    public function user_index(){
        $instansi = Instansi::all();
        $user = User::all()->except(1);
        return view('master_super.user_index',['instansi' => $instansi],['user' => $user]);
    }

    public function create_user(Request $request){
        $user = new User;
        $user -> nama = $request->nama;
        $user -> nip = $request->nip;
        $user -> role = $request->role;
        $user -> password = bcrypt($request->password);
        $user -> instansi_id = $request->instansi_id;
        $user -> save();
        return redirect()->back()->with('Sukses','Data Berhasil Diinput');
    }
    public function update_user_index($id){
        $user = User::find($id);
        $instansi = Instansi::all();
        return view('master_super.user_update',['instansi' => $instansi],['user' => $user]);
    }
    public function update_user(Request $request, $id){
        $user = User::find($id);
        $request->request->add(['password'=> $user->password]);
        $user->update($request->all());
        // dd($request->all());
        return redirect('/super/user')->with('Sukses','Data Berhasil Di Update');
    }
}
