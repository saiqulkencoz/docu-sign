<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\uploadpdf;

class AdminController extends Controller
{

    public function pengajuan(){
        $pdf = uploadpdf::all();
        return view ('master_adm.pengajuan_index',['data_pdf' => $pdf]);
    }

    public function uploadpdf(Request $request){
        //return dd($request->all());
        $nm = $request->pdf;
        $namaFile = $request->nama.='.pdf';
            $dtUpload = new uploadpdf;
            $dtUpload->nama = $namaFile;
            $dtUpload->pdf = $namaFile;
        $nm->move(public_path().'/pdf',$namaFile);
        $dtUpload->save();
        
        return redirect()->route('adm-pengajuan');
    }
    public function deletepdf(Request $request){
        
    }
}
