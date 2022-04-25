<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use App\uploadpdf;

class AdminController extends Controller
{

    public function pengajuan(){
        $pdf = uploadpdf::all();
        return view ('master_adm.pengajuan_index',['data_pdf' => $pdf]);
    }

    public function uploadpdf(Request $request){
        //e-sign process
        $file = $request->pdf;
        $sign = Http::withBasicAuth('test','qwerty')
        ->attach(
            'file', file_get_contents($file->path()),$file->getClientOriginalName())
        ->post('http://103.211.82.20/api/sign/pdf', [
            'nik' => '0803202100007062',
            'passphrase' => '!Bsre1221*',
            'tampilan' => 'invisible'
        ]);
        //save public
        $namaFile = time().rand(100,999).".".$file->getClientOriginalExtension();
            $dtUpload = new uploadpdf;
            $dtUpload->nama = $request->nama;
            $dtUpload->pdf = $namaFile;
            $dtUpload->signed_id = $sign->headers()['id_dokumen']['0'];
            $dtUpload->status = 'Menunggu Verifikasi';
            $dtUpload->instansi_id = Auth()->user()->instansi_id;
        $file->move(public_path().'/pdf',$namaFile);
        $dtUpload->save();
        
        return redirect()->route('adm-pengajuan');
    }
    public function deletepdf(Request $request){
        
    }
}
