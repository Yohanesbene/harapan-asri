<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function index(){
        $users = DB::table('users')
            ->select('users.id', 'roleusers.description', 'pegawai.nama', 'users.username', 'users.status')
            ->leftJoin('roleusers', 'roleusers.id', 'users.roleid')
            ->leftJoin('pegawai', 'pegawai.id', 'users.pegawaiid')
            ->get();
        return view('admin.dataUser', compact('users'));
    }

    public function create(){
        return view('admin.tambahUser');
    }
}
