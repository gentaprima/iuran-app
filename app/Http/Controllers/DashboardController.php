<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{   


    public function home(){
        $isLogin = Session::get('login');
        if($isLogin == null){
            return redirect('/');
        }
        return view('dashboard');
    }

    public function dataWarga(){
        $isLogin = Session::get('login');
        if($isLogin == null){
            return redirect('/');
        }
        return view('data-warga');
    }
}
