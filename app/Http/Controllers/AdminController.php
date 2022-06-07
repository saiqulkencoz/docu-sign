<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Auth;
use PDF;
use App\uploadpdf;

class AdminController extends Controller
{

    public function pengajuan(Request $request){
        $id = Auth()->user()->instansi_id;
        if($request->has('tanggal')){
            $pdf = uploadpdf::where('instansi_id',$id)->where('tanggal','LIKE','%'.$request->tanggal.'%')->get();
        }
        else if($request->has('nama')){
            $pdf = uploadpdf::where('instansi_id',$id)->where('nama','LIKE','%'.$request->nama.'%')->get();
        }
        else{
            $pdf = uploadpdf::all()->where('instansi_id',$id);
        }    
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

        //save dokumen pada public path
        $namaFile = time().rand(100,999).".".$file->getClientOriginalExtension();
        $file->move(public_path().'/pdf',$namaFile);
        
        //save hasil e-sign
        $response = Http::withBasicAuth('test','qwerty')
        ->get('http://103.211.82.20/api/sign/download/'.$sign->headers()['id_dokumen']['0']);
        $filename = $namaFile;
        Storage::disk()->put($filename,$response);

        //input database
        $dtUpload = new uploadpdf;
        $dtUpload->nama = $request->nama;
        $dtUpload->tanggal = $request->tanggal;
        $dtUpload->pdf = $namaFile;
        $dtUpload->status = 'Menunggu Verifikasi';
        $dtUpload->instansi_id = Auth()->user()->instansi_id;
        $dtUpload->save();
        return redirect()->route('adm-pengajuan')->with('Sukses','Data Berhasil Diinput');
    }

    public function viewupdate($id){
        $data = uploadpdf::find($id);
        return view('master_adm.viewupdate',compact('data'));
    }

    public function updatepdf(Request $request, $id){
        //delete previous file
        $data = uploadpdf::find($id);
        $path = public_path('/pdf'.'/'.$data->pdf);
        File::delete($path);
        if(Storage::disk()->exists($data->pdf)){
            Storage::delete($data->pdf);
        }
        //esign process
        $file = $request->pdf;
        $sign = Http::withBasicAuth('test','qwerty')
        ->attach(
            'file', file_get_contents($file->path()),$file->getClientOriginalName())
        ->post('http://103.211.82.20/api/sign/pdf', [
            'nik' => '0803202100007062',
            'passphrase' => '!Bsre1221*',
            'tampilan' => 'invisible'
        ]);
        //save dokumen public path
        $namaFile = time().rand(100,999).".".$file->getClientOriginalExtension();
        $file->move(public_path().'/pdf',$namaFile);

        //save hasil e-sign
        $response = Http::withBasicAuth('test','qwerty')
        ->get('http://103.211.82.20/api/sign/download/'.$sign->headers()['id_dokumen']['0']);
        $filename = $namaFile;
        Storage::disk()->put($filename,$response);

        //update database
        $data->nama = $request->nama;
        $data->tanggal = $request->tanggal;
        $data->pdf = $namaFile;
        $data->status = 'Menunggu Verifikasi';
        $data->save();
        return redirect()->route('adm-pengajuan')->with('Sukses','Data Berhasil Diubah');
    }
    public function deletepdf($id){
        $data = uploadpdf::find($id);
        $path = public_path('/pdf'.'/'.$data->pdf);
        File::delete($path);
        if(Storage::disk()->exists($data->pdf)){
            Storage::delete($data->pdf);
        }
        $data->delete($data);
        return redirect()->back()->with('Sukses','Data Berhasil Dihapus');
    }

    public function download_index(Request $request){
        $id = Auth()->user()->instansi_id;
        if($request->has('tanggal')){
            $pdf = uploadpdf::where('instansi_id',$id)->where('status','Dokumen Disetujui')
            ->where('tanggal','LIKE','%'.$request->tanggal.'%')->get();
        }
        else if($request->has('nama')){
            $pdf = uploadpdf::where('instansi_id',$id)->where('status','Dokumen Disetujui')
            ->where('nama','LIKE','%'.$request->nama.'%')->get();
        }
        else{
            $pdf = uploadpdf::all()->where('instansi_id',$id)->where('status','Dokumen Disetujui');
        }
        return view ('master_adm.download_index',['data_pdf' => $pdf]);
    }

    public function download_bsre($id){
        $data = uploadpdf::find($id);
        return Storage::download($data->pdf);
    }

    public function statistik(Request $request){
        $status = ['Menunggu Verifikasi','Memerlukan Revisi','Dokumen Disetujui'];
        if($request->has('tanggal')){
            $setuju = uploadpdf::where('instansi_id', '=', auth()->user()->instansi->id)
            ->where('status', '=', 'Dokumen Disetujui')
            ->where('tanggal','LIKE','%'.$request->tanggal.'%')->count();
            $revisi = uploadpdf::where('instansi_id', '=', auth()->user()->instansi->id)
            ->where('status', '=', 'Memerlukan Revisi')
            ->where('tanggal','LIKE','%'.$request->tanggal.'%')->count();
            $menunggu = uploadpdf::where('instansi_id', '=', auth()->user()->instansi->id)
            ->where('status', '=', 'Menunggu Verifikasi')
            ->where('tanggal','LIKE','%'.$request->tanggal.'%')->count();
            $now = $request->tanggal;
            return view ('master_adm.statistik',compact('status','setuju','revisi','menunggu','now'));
        }
        else{
            $now = Carbon::now()->format('F Y');
            $setuju = uploadpdf::where('instansi_id', '=', auth()->user()->instansi->id)
            ->where('status', '=', 'Dokumen Disetujui')
            ->where('tanggal','LIKE','%'.$now.'%')->count();
            $revisi = uploadpdf::where('instansi_id', '=', auth()->user()->instansi->id)
            ->where('status', '=', 'Memerlukan Revisi')
            ->where('tanggal','LIKE','%'.$now.'%')->count();
            $menunggu = uploadpdf::where('instansi_id', '=', auth()->user()->instansi->id)
            ->where('status', '=', 'Menunggu Verifikasi')
            ->where('tanggal','LIKE','%'.$now.'%')->count();
            return view ('master_adm.statistik',compact('status','setuju','revisi','menunggu','now'));
        }
    }

    public function cek_view(){
        return view ('master_adm.cekdokumen');
    }

    public function cek_dokumen(Request $request){
        $file = $request->pdf;
        $response = Http::withBasicAuth('test','qwerty')
                    ->attach('signed_file', file_get_contents($file->path()),$file->getClientOriginalName())
                    ->post('http://103.211.82.20/api/sign/verify');
        return redirect()->back()->with('Sukses',Arr::get($response->json(),'notes'));            
    }
}
