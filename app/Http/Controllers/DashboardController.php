<?php

namespace App\Http\Controllers;

use App\Models\ModelIuran;
use App\Models\ModelRekening;
use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{   


    public function home(){
        $isLogin = Session::get('login');
        $dataIuran = DB::table('tbl_iuran')->whereMonth('date',date('m'))->first();
        $data = [
            'dataIuran' => $dataIuran
        ];
        if($isLogin == null){
            return redirect('/');
        }
        return view('dashboard',$data);
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

    public function dataIuran(){
        $isLogin = Session::get('login');
        if($isLogin == null){
            return redirect('/');
        }
        $dataIuran = DB::table('tbl_iuran')
                        ->select('tbl_iuran.*','tbl_rekening.number_account','tbl_rekening.bank_name','tbl_rekening.account_name')
                        ->leftJoin('tbl_users','tbl_iuran.id_users','=','tbl_users.id')
                        ->leftJoin('tbl_rekening','tbl_iuran.to_rekening','=','tbl_rekening.id')
                        ->where('id_users','=',Session::get('dataUsers')->id)
                        ->get();
        $dataRekening = ModelRekening::all();
        $data = [
            'dataIuran' => $dataIuran,
            'dataRekening' => $dataRekening
        ];
        return view('data-iuran',$data);
    }

    public function dataIuranWarga(){
        $isLogin = Session::get('login');
        if($isLogin == null){
            return redirect('/');
        }
        $dataIuran = DB::table('tbl_iuran')
                        ->select('tbl_iuran.*','tbl_rekening.number_account','tbl_rekening.bank_name','tbl_rekening.account_name')
                        ->leftJoin('tbl_users','tbl_iuran.id_users','=','tbl_users.id')
                        ->leftJoin('tbl_rekening','tbl_iuran.to_rekening','=','tbl_rekening.id')
                        ->get();
        $dataRekening = ModelRekening::all();
        $data = [
            'dataIuran' => $dataIuran,
            'dataRekening' => $dataRekening
        ];
        return view('data-iuran',$data);
    }

    
}

