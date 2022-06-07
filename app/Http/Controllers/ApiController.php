<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\User;
use App\uploadpdf;
use App\Instansi;

class ApiController extends Controller
{
    public function login(Request $request, User $user)
    {
        if (!Auth::attempt(['nip' => $request->nip, 'password' => $request->password])){
            return response()->json([
                'response_code' => 401,
                'message' => 'Identitas tidak ditemukan',
            ]);
        }
        $user = $user->find(Auth::user()->id);

        return response()->json([
            'response_code' => 200,
            'message' => 'Login Berhasil',
            'conntent' => $user
        ]);
    }

    public function index($id)
    {
        return response()->json(uploadpdf::all()->where('instansi_id',$id));
    }

    public function instansi()
    {
        return response()->json(Instansi::all());
    }

    public function terima(Request $request, uploadpdf $pdf){
        $pdf = uploadpdf::find($request->id);
        $pdf->status = 'Dokumen Disetujui';
        $pdf->save();
        return response()->json(['Berhasil' => 'Status diubah menjadi disetujui',
                                 'data' => $pdf]);
    }

    public function tolak(Request $request, uploadpdf $pdf){
        $pdf = uploadpdf::find($request->id);
        $pdf->status = 'Memerlukan Revisi';
        $pdf->note = $request->note;
        $pdf->save();
        return response()->json(['Berhasil' => 'Status diubah menjadi direvisi',
                                 'note' => $request->note,
                                 'data' => $pdf]);
    }

}
