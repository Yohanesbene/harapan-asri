<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

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
            'alamatPJ' => $request->alamat,
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

        $newImageName = time() . '-' . $request->namalengkap . '.' . $request->image->extension();

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
        $client = DB::table('penghuni')->where('id', $id)->first();
        // DD($client);
        $file = public_path('images/') . $client->foto;

        // Cek jika ada gambar
        if (file_exists($file)) {
            @unlink($file);
        }

        // Hapus data di database
        DB::table('penghuni')->where('id', $id)->delete();

        return redirect()->route('user.dashboard')->with('success', 'Data Berhasil Dihapus!');
    }

    public function edit($id){
        $penghuni = DB::table('penghuni')
            ->select('penghuni.id', 'penghuni.pjid', 'pj.nama', 'penghuni.foto', 'penghuni.namaLengkap', 'penghuni.namaPanggilan', 'penghuni.tgllahir', 'penghuni.gender', 'penghuni.agama',
                    'penghuni.alamat', 'penghuni.notelp', 'penghuni.asalDaerah', 'penghuni.ruang', 'penghuni.tglMasuk', 'penghuni.tglKeluar', 'penghuni.meninggal',
                    'penghuni.keluar')
            ->where('penghuni.id', $id)
            ->leftJoin('pj', 'pj.id', 'penghuni.pjid')
            ->first();
        $pj = DB::table('pj')->get();
        return view('user.editClient', compact('pj', 'penghuni'));
    }

    public function update(Request $request){

        $query = DB::table('penghuni')->where('id', $request->id)->first();
        // DD($query);
        $awal = $query->foto;
        // Storage::disk('local')->delete('public/images/' . $query->foto);


        // $newImageName = time() . '-' . $request->namalengkap . '.' . $request->image->extension();

        $destinationPath = 'images';

        $data = [
                'pjid' => $request->pjid,
                'foto' => $awal,
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
                'keluar' => $request->keluar
        ];

        $request->image->move(public_path($destinationPath), $awal);

        DB::table('penghuni')->where('id', $request->id)->update($data);

        return redirect()->route('user.dashboard')->with('success', 'Data Berhasil Diupdate!');
    }

    public function printListClient(){
        $penghuni = DB::table('penghuni')
            ->select('penghuni.id', 'pj.nama', 'penghuni.namaLengkap', 'penghuni.ruang')
            ->leftJoin('pj', 'pj.id', 'penghuni.pjid')
            ->get();
        return view('user.listPenghuni', compact('penghuni'));
    }

    public function printDetailClient($id){
        $penghuni = DB::table('penghuni')
            ->select('penghuni.id', 'penghuni.pjid', 'pj.nama', 'pj.alamatPJ', 'pj.telpon', 'penghuni.namaLengkap', 'penghuni.namaPanggilan',
                    'penghuni.foto', 'penghuni.tgllahir', 'penghuni.gender', 'penghuni.agama', 'penghuni.alamat', 'penghuni.notelp', 'penghuni.asalDaerah', 'penghuni.ruang',
                    'penghuni.tglMasuk', 'penghuni.tglKeluar', 'penghuni.meninggal', 'penghuni.keluar')
            ->where('penghuni.id', $id)
            ->leftJoin('pj', 'pj.id', 'penghuni.pjid')
            ->get();
        // DD($penghuni);
        $beratbadan = DB::table('beratbadan')
            ->select('beratbadan.id', 'penghuni.namaLengkap', 'beratbadan.hasil', 'beratbadan.waktu')
            ->where('beratbadan.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'beratbadan.penghuniid')
            ->get();
        // DD($beratbadan);
        $nadi = DB::table('nadi')
            ->select('nadi.id', 'penghuni.namaLengkap', 'nadi.hasil', 'nadi.waktu')
            ->where('nadi.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'nadi.penghuniid')
            ->get();
        $suhu = DB::table('suhubadan')
            ->select('suhubadan.id', 'penghuni.namaLengkap', 'suhubadan.hasil', 'suhubadan.waktu')
            ->where('suhubadan.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'suhubadan.penghuniid')
            ->get();
        $spo2 = DB::table('spo2')
            ->select('spo2.id', 'penghuni.namaLengkap', 'spo2.hasil', 'spo2.waktu')
            ->where('spo2.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'spo2.penghuniid')
            ->get();
        $tekananDarah = DB::table('tekanandarah')
            ->select('tekanandarah.id', 'penghuni.namaLengkap', 'tekanandarah.systole', 'tekanandarah.diastole', 'tekanandarah.waktu')
            ->where('tekanandarah.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'tekanandarah.penghuniid')
            ->get();
        $cekObat = DB::table('cekobat')
            ->select('cekobat.id', 'penghuni.namaLengkap', 'cekobat.obatid', 'cekobat.dosis', 'cekobat.dikonsumsi', 'cekobat.waktu')
            ->where('cekobat.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'cekobat.penghuniid')
            ->get();
        $pemberianObat = DB::table('pemberianobat')
            ->select('pemberianobat.id', 'penghuni.namaLengkap', 'pemberianobat.obatid', 'pemberianobat.dosis', 'pemberianobat.efeksamping', 'pemberianobat.waktu')
            ->where('pemberianobat.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'pemberianobat.penghuniid')
            ->get();
        $nutrisi = DB::table('nutrisi')
            ->select('nutrisi.id', 'penghuni.namaLengkap', 'nutrisi.keterangan', 'nutrisi.waktu')
            ->where('nutrisi.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'nutrisi.penghuniid')
            ->get();
        $cairan = DB::table('cairan')
            ->select('cairan.id', 'penghuni.namaLengkap', 'cairan.keterangan', 'cairan.waktu')
            ->where('cairan.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'cairan.penghuniid')
            ->get();
        $gds = DB::table('gds')
            ->select('gds.id', 'penghuni.namaLengkap', 'gds.hasil', 'gds.waktu')
            ->where('gds.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'gds.penghuniid')
            ->get();
        $asamUrat = DB::table('asamurat')
            ->select('asamurat.id', 'penghuni.namaLengkap', 'asamurat.hasil', 'asamurat.waktu')
            ->where('asamurat.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'asamurat.penghuniid')
            ->get();
        $koleterol = DB::table('kolesterol')
            ->select('kolesterol.id', 'penghuni.namaLengkap', 'kolesterol.hasil', 'kolesterol.waktu')
            ->where('kolesterol.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'kolesterol.penghuniid')
            ->get();
        $kolesterol = DB::table('kolesterol')
            ->select('kolesterol.id', 'penghuni.namaLengkap', 'kolesterol.hasil', 'kolesterol.waktu')
            ->where('kolesterol.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'kolesterol.penghuniid')
            ->get();
        return view('user.detailPenghuniPDF', compact('penghuni', 'beratbadan', 'nadi', 'suhu', 'spo2', 'tekananDarah', 'cekObat', 'pemberianObat', 'nutrisi',
                    'cairan', 'gds', 'asamUrat', 'kolesterol'));
    }

    public function detail($id){
        $penghuni = DB::table('penghuni')
            ->select('penghuni.id', 'penghuni.pjid', 'pj.nama', 'pj.alamatPJ', 'pj.telpon', 'penghuni.namaLengkap', 'penghuni.namaPanggilan',
                    'penghuni.foto', 'penghuni.tgllahir', 'penghuni.gender', 'penghuni.agama', 'penghuni.alamat', 'penghuni.notelp', 'penghuni.asalDaerah', 'penghuni.ruang',
                    'penghuni.tglMasuk', 'penghuni.tglKeluar', 'penghuni.meninggal', 'penghuni.keluar')
            ->where('penghuni.id', $id)
            ->leftJoin('pj', 'pj.id', 'penghuni.pjid')
            ->get();
        // DD($penghuni);
        $beratbadan = DB::table('beratbadan')
            ->select('beratbadan.id', 'penghuni.namaLengkap', 'beratbadan.hasil', 'beratbadan.waktu')
            ->where('beratbadan.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'beratbadan.penghuniid')
            ->get();
        // DD($beratbadan);
        $nadi = DB::table('nadi')
            ->select('nadi.id', 'penghuni.namaLengkap', 'nadi.hasil', 'nadi.waktu')
            ->where('nadi.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'nadi.penghuniid')
            ->get();
        $suhu = DB::table('suhubadan')
            ->select('suhubadan.id', 'penghuni.namaLengkap', 'suhubadan.hasil', 'suhubadan.waktu')
            ->where('suhubadan.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'suhubadan.penghuniid')
            ->get();
        $spo2 = DB::table('spo2')
            ->select('spo2.id', 'penghuni.namaLengkap', 'spo2.hasil', 'spo2.waktu')
            ->where('spo2.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'spo2.penghuniid')
            ->get();
        $tekananDarah = DB::table('tekanandarah')
            ->select('tekanandarah.id', 'penghuni.namaLengkap', 'tekanandarah.systole', 'tekanandarah.diastole', 'tekanandarah.waktu')
            ->where('tekanandarah.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'tekanandarah.penghuniid')
            ->get();
        $cekObat = DB::table('cekobat')
            ->select('cekobat.id', 'penghuni.namaLengkap', 'cekobat.obatid', 'cekobat.dosis', 'cekobat.dikonsumsi', 'cekobat.waktu')
            ->where('cekobat.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'cekobat.penghuniid')
            ->get();
        $pemberianObat = DB::table('pemberianobat')
            ->select('pemberianobat.id', 'penghuni.namaLengkap', 'pemberianobat.obatid', 'pemberianobat.dosis', 'pemberianobat.efeksamping', 'pemberianobat.waktu')
            ->where('pemberianobat.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'pemberianobat.penghuniid')
            ->get();
        $nutrisi = DB::table('nutrisi')
            ->select('nutrisi.id', 'penghuni.namaLengkap', 'nutrisi.keterangan', 'nutrisi.waktu')
            ->where('nutrisi.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'nutrisi.penghuniid')
            ->get();
        $cairan = DB::table('cairan')
            ->select('cairan.id', 'penghuni.namaLengkap', 'cairan.keterangan', 'cairan.waktu')
            ->where('cairan.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'cairan.penghuniid')
            ->get();
        $gds = DB::table('gds')
            ->select('gds.id', 'penghuni.namaLengkap', 'gds.hasil', 'gds.waktu')
            ->where('gds.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'gds.penghuniid')
            ->get();
        $asamUrat = DB::table('asamurat')
            ->select('asamurat.id', 'penghuni.namaLengkap', 'asamurat.hasil', 'asamurat.waktu')
            ->where('asamurat.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'asamurat.penghuniid')
            ->get();
        $koleterol = DB::table('kolesterol')
            ->select('kolesterol.id', 'penghuni.namaLengkap', 'kolesterol.hasil', 'kolesterol.waktu')
            ->where('kolesterol.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'kolesterol.penghuniid')
            ->get();
        $kolesterol = DB::table('kolesterol')
            ->select('kolesterol.id', 'penghuni.namaLengkap', 'kolesterol.hasil', 'kolesterol.waktu')
            ->where('kolesterol.penghuniid', $id)
            ->leftJoin('penghuni', 'penghuni.id', 'kolesterol.penghuniid')
            ->get();
        return view('user.detailClient', compact('penghuni', 'beratbadan', 'nadi', 'suhu', 'spo2', 'tekananDarah', 'cekObat', 'pemberianObat', 'nutrisi',
                    'cairan', 'gds', 'asamUrat', 'kolesterol'));
    }

}
