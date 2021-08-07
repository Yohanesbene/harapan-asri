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
        
        return redirect('/user/keperawatan')->with('success', 'Data berat badan berhasil diinput');
    }

    public function createNadi(){
        // $pegawai = DB::table('pegawai')->get();
        $penghuni = DB::table('penghuni')->get();
        return view('user.tambahNadi', compact('penghuni'));
    }

    public function storeNadi(Request $request){
        // DD($request);
        $request->validate([
            'penghuni' => 'required',
            'hasil' => 'required',
        ]);

        DB::table('nadi')
            ->insert([
                'pegawaiid' => Auth::user()->id,
                'penghuniid' => $request->penghuni,
                'hasil' => $request->hasil
            ]);
        
        return redirect('/user/keperawatan')->with('success', 'Data nadi berhasil diinput');
    }

    public function createSuhu(){
        // $pegawai = DB::table('pegawai')->get();
        $penghuni = DB::table('penghuni')->get();
        return view('user.tambahSuhu', compact('penghuni'));
    }

    public function storeSuhu(Request $request){
        // DD($request);
        $request->validate([
            'penghuni' => 'required',
            'hasil' => 'required',
        ]);

        DB::table('suhubadan')
            ->insert([
                'pegawaiid' => Auth::user()->id,
                'penghuniid' => $request->penghuni,
                'hasil' => $request->hasil
            ]);
        
        return redirect('/user/keperawatan')->with('success', 'Data suhu badan berhasil diinput');
    }

    public function createSpO2(){
        // $pegawai = DB::table('pegawai')->get();
        $penghuni = DB::table('penghuni')->get();
        return view('user.tambahSpO2', compact('penghuni'));
    }

    public function storeSpO2(Request $request){
        // DD($request);
        $request->validate([
            'penghuni' => 'required',
            'hasil' => 'required',
        ]);

        DB::table('spo2')
            ->insert([
                'pegawaiid' => Auth::user()->id,
                'penghuniid' => $request->penghuni,
                'hasil' => $request->hasil
            ]);
        
        return redirect('/user/keperawatan')->with('success', 'Data SpO2 berhasil diinput');
    }

    public function createTekananDarah(){
        // $pegawai = DB::table('pegawai')->get();
        $penghuni = DB::table('penghuni')->get();
        return view('user.tambahTekananDarah', compact('penghuni'));
    }

    public function storeTekananDarah(Request $request){
        // DD($request);
        $request->validate([
            'penghuni' => 'required',
            'systole' => 'required',
            'diastole' => 'required',
        ]);

        DB::table('tekanandarah')
            ->insert([
                'pegawaiid' => Auth::user()->id,
                'penghuniid' => $request->penghuni,
                'systole' => $request->systole,
                'diastole' => $request->diastole
            ]);
        
        return redirect('/user/keperawatan')->with('success', 'Data tekanan darah berhasil diinput');
    }

    public function createCekObat(){
        // $pegawai = DB::table('pegawai')->get();
        $penghuni = DB::table('penghuni')->get();
        return view('user.tambahCekObat', compact('penghuni'));
    }

    public function storeCekObat(Request $request){
        // DD($request);
        $request->validate([
            'penghuni' => 'required',
            'obat' => 'required',
            'dosis' => 'required',
            'dikonsumsi' => 'required',
        ]);

        DB::table('cekobat')
            ->insert([
                'pegawaiid' => Auth::user()->id,
                'penghuniid' => $request->penghuni,
                'obatid' => $request->obat,
                'dosis' => $request->dosis,
                'dikonsumsi' => $request->dikonsumsi,
            ]);
        
        return redirect('/user/keperawatan')->with('success', 'Data Cek Obat berhasil diinput');
    }

    public function createPemberianObat(){
        // $pegawai = DB::table('pegawai')->get();
        $penghuni = DB::table('penghuni')->get();
        return view('user.tambahPemberianObat', compact('penghuni'));
    }

    public function storePemberianObat(Request $request){
        // DD($request);
        $request->validate([
            'penghuni' => 'required',
            'obat' => 'required',
            'dosis' => 'required',
            'efek' => 'required',
        ]);

        DB::table('pemberianobat')
            ->insert([
                'pegawaiid' => Auth::user()->id,
                'penghuniid' => $request->penghuni,
                'obatid' => $request->obat,
                'dosis' => $request->dosis,
                'efeksamping' => $request->efek,
            ]);
        
        return redirect('/user/keperawatan')->with('success', 'Data Pemberian Obat berhasil diinput');
    }

    public function createNutrisi(){
        // $pegawai = DB::table('pegawai')->get();
        $penghuni = DB::table('penghuni')->get();
        return view('user.tambahNutrisi', compact('penghuni'));
    }

    public function storeNutrisi(Request $request){
        // DD($request);
        $request->validate([
            'penghuni' => 'required',
            'keterangan' => 'required'
        ]);

        DB::table('nutrisi')
            ->insert([
                'pegawaiid' => Auth::user()->id,
                'penghuniid' => $request->penghuni,
                'keterangan' => $request->keterangan
            ]);
        
        return redirect('/user/keperawatan')->with('success', 'Data Nutrisi berhasil diinput');
    }

    public function createCairan(){
        // $pegawai = DB::table('pegawai')->get();
        $penghuni = DB::table('penghuni')->get();
        return view('user.tambahCairan', compact('penghuni'));
    }

    public function storeCairan(Request $request){
        // DD($request);
        $request->validate([
            'penghuni' => 'required',
            'keterangan' => 'required'
        ]);

        DB::table('cairan')
            ->insert([
                'pegawaiid' => Auth::user()->id,
                'penghuniid' => $request->penghuni,
                'keterangan' => $request->keterangan
            ]);
        
        return redirect('/user/keperawatan')->with('success', 'Data Cairan berhasil diinput');
    }

    public function createGDS(){
        // $pegawai = DB::table('pegawai')->get();
        $penghuni = DB::table('penghuni')->get();
        return view('user.tambahGDS', compact('penghuni'));
    }

    public function storeGDS(Request $request){
        // DD($request);
        $request->validate([
            'penghuni' => 'required',
            'hasil' => 'required'
        ]);

        DB::table('gds')
            ->insert([
                'pegawaiid' => Auth::user()->id,
                'penghuniid' => $request->penghuni,
                'hasil' => $request->hasil
            ]);
        
        return redirect('/user/keperawatan')->with('success', 'Data GDS berhasil diinput');
    }

    public function createAsamUrat(){
        // $pegawai = DB::table('pegawai')->get();
        $penghuni = DB::table('penghuni')->get();
        return view('user.tambahAsamUrat', compact('penghuni'));
    }

    public function storeAsamUrat(Request $request){
        // DD($request);
        $request->validate([
            'penghuni' => 'required',
            'hasil' => 'required'
        ]);

        DB::table('asamurat')
            ->insert([
                'pegawaiid' => Auth::user()->id,
                'penghuniid' => $request->penghuni,
                'hasil' => $request->hasil
            ]);
        
        return redirect('/user/keperawatan')->with('success', 'Data asam urat berhasil diinput');
    }

    public function createKolesterol(){
        // $pegawai = DB::table('pegawai')->get();
        $penghuni = DB::table('penghuni')->get();
        return view('user.tambahKolesterol', compact('penghuni'));
    }

    public function storeKolesterol(Request $request){
        // DD($request);
        $request->validate([
            'penghuni' => 'required',
            'hasil' => 'required'
        ]);

        DB::table('kolesterol')
            ->insert([
                'pegawaiid' => Auth::user()->id,
                'penghuniid' => $request->penghuni,
                'hasil' => $request->hasil
            ]);
        
        return redirect('/user/keperawatan')->with('success', 'Data kolesterol berhasil diinput');
    }

    public function createMobilisasi(){
        // $pegawai = DB::table('pegawai')->get();
        $penghuni = DB::table('penghuni')->get();
        return view('user.tambahMobilisasi', compact('penghuni'));
    }

    public function storeMobilisasi(Request $request){
        // DD($request);
        $request->validate([
            'penghuni' => 'required',
            'hasil' => 'required'
        ]);

        DB::table('mobilisasidini')
            ->insert([
                'pegawaiid' => Auth::user()->id,
                'penghuniid' => $request->penghuni,
                'hasil' => $request->hasil
            ]);
        
        return redirect('/user/keperawatan')->with('success', 'Data Mobilisasi berhasil diinput');
    }

    public function createPeminjamanAlat(){
        // $pegawai = DB::table('pegawai')->get();
        $penghuni = DB::table('penghuni')->get();
        return view('user.tambahPeminjamanAlat', compact('penghuni'));
    }

    public function storePeminjamanAlat(Request $request){
        // DD($request);
        $request->validate([
            'penghuni' => 'required',
            'jenisalat' => 'required',
            'ukuran' => 'required'
        ]);

        DB::table('peminjamanalat')
            ->insert([
                'peminjam' => Auth::user()->id,
                'penghuniid' => $request->penghuni,
                'jenisalat' => $request->jenisalat,
                'ukuran' => $request->ukuran
            ]);
        
        return redirect('/user/keperawatan')->with('success', 'Data Pemakaian Alat berhasil diinput');
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
