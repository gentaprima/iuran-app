<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home(){
        return view('dashboard');
    }

    public function dataWarga(){
        return view('data-warga');
    }
}
