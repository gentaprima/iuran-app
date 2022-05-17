<?php

namespace App\Http\Controllers;

use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $dataWarga =  DB::table('tbl_users')
                            ->where('role','=',0)
                            ->where('is_verif','=',1)
                            ->get();
        $data = [
            'dataWarga'    => $dataWarga
        ];
        return view('data-warga',$data);
    }

    public function dataVerifikasiWarga(){
        $isLogin = Session::get('login');
        if($isLogin == null){
            return redirect('/');
        }
        $dataVerifikasi =  DB::table('tbl_users')
                            ->where('role','=',0)
                            ->where('number_family_card','!=',NULL)
                            ->where('is_verif','=',0)
                            ->get();
        $data = [
            'dataVerifikasi'    => $dataVerifikasi
        ];
        return view('data-verifikasi-warga',$data);
    }

    
}

