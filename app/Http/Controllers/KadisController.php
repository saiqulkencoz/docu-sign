<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\uploadpdf;

class KadisController extends Controller
{
    public function index(Request $request){
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
        return view ('kadis.dokumen',['data_pdf' => $pdf]);
    }

    public function terima($id){
        $dokumen = uploadpdf::find($id);
        $dokumen->status = 'Dokumen Disetujui';
        $dokumen->save();
        return redirect()->back()->with('Sukses','Dokumen sudah terverifikasi');
    }

    public function tolak(Request $request,$id){
        $dokumen = uploadpdf::find($id);
        $dokumen->status = 'Memerlukan Revisi';
        $dokumen->note = $request->note;
        $dokumen->save();
        return redirect()->back()->with('Sukses','Dokumen sudah dikembalikan untuk revisi'); 
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
            return view ('kadis.statistik',compact('status','setuju','revisi','menunggu','now'));
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
            return view ('kadis.statistik',compact('status','setuju','revisi','menunggu','now'));
        }
    }
}
