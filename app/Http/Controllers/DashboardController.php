<?php

namespace App\Http\Controllers;

use App\Models\ModelIuran;
use App\Models\ModelJenisIuran;
use App\Models\ModelRekening;
use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{   


    public function home(){
        $isLogin = Session::get('login');
        $dataIuran = DB::table('tbl_iuran')->whereMonth('date',date('m'))->first();
        $data = [
            'dataIuran' => $dataIuran,
            'dataWarga' => DB::table('tbl_users')->where('is_verif',1)->where('role',0)->get(),
            'dataPemasukan' => DB::table('tbl_pemasukan')->sum('jumlah'),
            'dataIuranUnVerif'  => DB::table('tbl_iuran')->where('is_verif',0)->groupBy('id_transaction')->get()
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
                        ->select('tbl_iuran.*','tbl_jenis_iuran.*','tbl_rekening.*',DB::raw('GROUP_CONCAT(tbl_jenis_iuran.jenis_iuran) as jenis_iuran'),DB::raw('GROUP_CONCAT(tbl_iuran.month) as month'))
                        ->leftJoin('tbl_jenis_iuran','tbl_iuran.id_jenis_iuran','=','tbl_jenis_iuran.id')
                        ->leftJoin('tbl_users','tbl_iuran.id_users','=','tbl_users.id')
                        ->leftJoin('tbl_rekening','tbl_iuran.to_rekening','=','tbl_rekening.id')
                        ->where('id_users','=',Session::get('dataUsers')->id)
                        ->groupBy('id_transaction')
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

    public function jenisIuran(){
        $isLogin = Session::get('login');
        if($isLogin == null){
            return redirect('/');
        }
        $dataJenis = ModelJenisIuran::all();
        $data = [
            'dataJenis' => $dataJenis,
        ];
        return view('data-jenis-iuran',$data);
    }
    
    public function formAddIuran(){
        $isLogin = Session::get('login');
        if($isLogin == null){
            return redirect('/');
        }
        $data = [
            'dataJenisIuran' => ModelJenisIuran::all(),
            'dataRekening'  => ModelRekening::all()
        ];
        return view('form-tambah-iuran',$data);
    }

    public function formUpdateIuran(){
        $isLogin = Session::get('login');
        if($isLogin == null){
            return redirect('/');
        }
        $data = [
            'dataJenisIuran' => ModelJenisIuran::all(),
            'dataRekening'  => ModelRekening::all()
        ];
        return view('form-update-iuran',$data);
    }

    public function verifikasiIuran(){
        $isLogin = Session::get('login');
        if($isLogin == null){
            return redirect('/');
        }
        $dataIuran = DB::table('tbl_iuran')
                        ->select('tbl_iuran.*','tbl_jenis_iuran.*','tbl_rekening.*','tbl_users.first_name','tbl_users.last_name','tbl_users.phone_number','tbl_users.number_identity_card','tbl_users.number_family_card','tbl_users.photo',DB::raw('GROUP_CONCAT(tbl_jenis_iuran.jenis_iuran) as jenis_iuran'),DB::raw('GROUP_CONCAT(tbl_iuran.month) as month'))
                        ->leftJoin('tbl_jenis_iuran','tbl_iuran.id_jenis_iuran','=','tbl_jenis_iuran.id')
                        ->leftJoin('tbl_users','tbl_iuran.id_users','=','tbl_users.id')
                        ->leftJoin('tbl_rekening','tbl_iuran.to_rekening','=','tbl_rekening.id')
                        ->where('is_pay','=',1)
                        ->groupBy('id_transaction')
                        ->get();
        $dataRekening = ModelRekening::all();
        $data = [
            'dataIuran' => $dataIuran,
            'dataRekening' => $dataRekening
        ];
        return view('verifikasi-iuran-warga',$data);
    }

    public function dataPemasukan(Request $request){
        $isLogin = Session::get('login');
        if($isLogin == null){
            return redirect('/');
        }
        $month = date('m');
        $year = date('Y');
        if($request->month != null){
            $splitDate = explode('-',$request->month);
            $year = $splitDate[0];
            $month = $splitDate[1];
        }
        $dataPemasukan = DB::table('tbl_pemasukan')
                        ->leftJoin('tbl_iuran','tbl_pemasukan.id_transaction','=','tbl_iuran.id_transaction')
                        ->leftJoin('tbl_jenis_iuran','tbl_iuran.id_jenis_iuran','=','tbl_jenis_iuran.id')
                        ->leftJoin('tbl_users','tbl_iuran.id_users','=','tbl_users.id')
                        ->leftJoin('tbl_rekening','tbl_iuran.to_rekening','=','tbl_rekening.id')
                        ->whereMonth('tbl_pemasukan.date','=',$month)
                        ->whereYear('tbl_pemasukan.date','=',$year)
                        ->groupBy('tbl_iuran.id_transaction')
                        ->get();
        $data = [
            'dataPemasukan' => $dataPemasukan,
            'monthName' => date("F", mktime(0, 0, 0, $month, 10)),
        ];
        return view('data-pemasukan',$data);
    }
    
}

