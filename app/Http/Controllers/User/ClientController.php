<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class ClientController extends Controller
{
    public function index(){
        $penghuni = DB::table('penghuni')
            ->select('penghuni.id', 'pj.nama', 'penghuni.namaLengkap', 'penghuni.ruang')
            ->leftJoin('pj', 'pj.id', 'penghuni.pjid')
            ->paginate(10);
        return view('user.index', compact('penghuni'));
    }

    public function createPJ(){
        return view('user.tambahPJ');
    }

    public function storePJ(Request $request){
        DB::table('pj')->insert([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telpon' => $request->telpon,
        ]);

        return redirect('user/dataPenghuni/create');
    }

    public function create(){
        $pj = DB::table('pj')->get();
        return view('user.tambahClient', compact('pj'));
    }

    public function store(Request $request){
        // DD($request->all());

        $request->validate([
            'pj' => 'required',
            'namalengkap' => 'required|string',
            'namepgl' => 'required|string|max:255',
            'tgllahir' => 'required',
            'gender' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'notelp' => 'required',
            'asal' => 'required',
            'ruang' => 'required',
            'tglmasuk' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048',

        ]);

        $newImageName = time() . '-' . $request->namalengkap . '-' . $request->image->extension();

        $test = $request->image->move(public_path('images'), $newImageName);

        // dd($test);

        $penghuni = DB::table('penghuni')->insert([
            'pjid' => $request->pj,
            'namaLengkap' => $request->namalengkap,
            'namaPanggilan' => $request->namepgl,
            'tgllahir' => $request->tgllahir,
            'gender' => $request->gender,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'notelp' => $request->notelp,
            'asalDaerah' => $request->asal,
            'ruang' => $request->ruang,
            'tglMasuk' => $request->tglmasuk,
            'foto' => $newImageName,
        ]);

        if ($penghuni) {
            return redirect()->route('user.dashboard')->with('success', 'Data Berhasil Disimpan!');
        } else {
            return redirect()->route('user.dashboard')->with('error', 'Data Gagal Disimpan!');
        }

        // return redirect('user/dashboard');
    }

    public function delete($id){
        $client = DB::table('penghuni')->where('id','=',$id)->delete();
        return redirect('user/dashboard');
    }

    public function edit($id){
        $penghuni = DB::table('penghuni')
            ->select('penghuni.id', 'penghuni.pjid', 'pj.nama', 'penghuni.namaLengkap', 'penghuni.namaPanggilan', 'penghuni.tgllahir', 'penghuni.gender', 'penghuni.agama',
                    'penghuni.alamat', 'penghuni.notelp', 'penghuni.asalDaerah', 'penghuni.ruang', 'penghuni.tglMasuk', 'penghuni.tglKeluar', 'penghuni.meninggal',
                    'penghuni.keluar')
            ->where('penghuni.id', $id)
            ->leftJoin('pj', 'pj.id', 'penghuni.pjid')
            ->first();
        $pj = DB::table('pj')->get();
        return view('user.editClient', compact('pj', 'penghuni'));
    }

    public function update(Request $request){
        DB::table('penghuni')
            ->where('id', $request->id)
            ->update([
                'pjid' => $request->pjid,
                'namaLengkap' => $request->namalengkap,
                'namaPanggilan' => $request->namepgl,
                'tgllahir' => $request->tgllahir,
                'gender' => $request->gender,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
                'notelp' => $request->notelp,
                'asalDaerah' => $request->asal,
                'ruang' => $request->ruang,
                'tglMasuk' => $request->tglmasuk,
                'tglKeluar' => $request->tglkeluar,
                'meninggal' => $request->meninggal,
                'keluar' => $request->keluar,
            ]);
        return redirect('user/dashboard');
    }

    // public function update(Request $request, $id){
    //     DB::table('penghuni')->where('id', '=',$id)
    //     ->update(['pjid' => $request->pj],
    //     ['namaLengkap' => $request->namalengkap],
    //     ['namaPanggilan' => $request->namepgl],
    //     ['tgllahir' => $request->tgllahir],
    //     ['gender' => $request->gender],
    //     ['agama' => $request->agama],
    //     ['alamat' => $request->alamat],
    //     ['notelp' => $request->notelp],
    //     ['asalDaerah' => $request->asal],
    //     ['ruang' => $request->ruang],
    //     ['tglMasuk' => $request->tglmasuk]);
    //     return redirect('user/dashboard');
    // }

    public function printClient(){
        $penghuni = DB::table('penghuni')
            ->select('penghuni.id', 'pj.nama', 'penghuni.namaLengkap', 'penghuni.ruang')
            ->leftJoin('pj', 'pj.id', 'penghuni.pjid')
            ->get();
 
    	$pdf = PDF::loadview('user.penghuni_pdf',['penghuni'=>$penghuni]);
    	return $pdf->download('daftar_penghuni.pdf');
    }

    public function detail($id){
        $penghuni = DB::table('penghuni')
            ->where('penghuni.id', $id)
            ->leftJoin('pj', 'pj.id', 'penghuni.pjid')
            ->get();
        $beratbadan = DB::table('beratbadan')
            ->select('beratbadan.id', 'penghuni.namaLengkap', 'beratbadan.hasil', 'beratbadan.waktu')
            ->where('beratbadan.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'beratbadan.penghuniid')
            ->get();
        // DD($beratbadan);
        return view('user.detailClient', compact('penghuni', 'beratbadan'));
    }

}
