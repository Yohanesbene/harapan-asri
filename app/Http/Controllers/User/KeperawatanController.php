<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class KeperawatanController extends Controller
{
    public function index(){
        $penghuni = DB::table('penghuni')
            ->select('penghuni.id', 'penghuni.namaPanggilan')
            ->get();
        return view('user.keperawatan', compact('penghuni'));
    }

    public function menu($id){
        $penghuni = DB::table('penghuni')
            ->select('penghuni.id')
            ->get();
        return view('user.menuPerawat', compact('penghuni'));
    }
}
