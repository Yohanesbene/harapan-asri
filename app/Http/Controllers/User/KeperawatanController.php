<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class KeperawatanController extends Controller
{
    public function index(){
        // $penghuni = DB::table('penghuni')
        //     ->select('penghuni.id', 'penghuni.namaPanggilan')
        //     ->get();
        return view('user.menuPerawat');
    }

    // public function menu($id){
    //     $penghuni = DB::table('penghuni')
    //         ->select('penghuni.id')
    //         ->get();
    //     return view('user.menuPerawat', compact('penghuni'));
    // }

    public function createBerat(){
        // $pegawai = DB::table('pegawai')->get();
        $penghuni = DB::table('penghuni')->get();
        return view('user.tambahBerat', compact('penghuni'));
    }

    public function storeBerat(Request $request){
        // DD($request);
        $request->validate([
            'penghuni' => 'required',
            'hasil' => 'required',
        ]);

        DB::table('beratbadan')
            ->insert([
                'pegawaiid' => Auth::user()->id,
                'penghuniid' => $request->penghuni,
                'hasil' => $request->hasil
            ]);
        
        return redirect('/user/keperawatan')->with('success', 'Data berhasil diinput');
    }
    // public function loadPenghuni(Request $request){
    //     if ($request->has('q')) {
    //         $cari = $request->q;
    //         $penghuni = DB::table('penghuni')
    //                     ->select('id', 'namaLengkap')
    //                     ->where('namaLengkap', 'LIKE', '%$cari%')
    //                     ->get();
    //         return response()->json($penghuni); 
    //     }
    // }
}
