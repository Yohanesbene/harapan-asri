<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->roleid == 1) {
            return redirect('admin/dashboard');
        } else {
            return redirect('user/dashboard');
        }

    }
}
