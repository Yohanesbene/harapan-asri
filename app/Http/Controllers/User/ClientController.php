<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ClientController extends Controller
{
    public function index(){
        $penghuni = DB::table('penghuni')
            ->select('penghuni.id', 'pj.nama', 'penghuni.namaLengkap', 'penghuni.ruang')
            ->leftJoin('pj', 'pj.id', 'penghuni.pjid')
            ->get();
        return view('user.index', compact('penghuni'));
    }
}
