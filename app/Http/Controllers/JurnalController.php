<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurnalController extends Controller
{
    public function index(){
        $dataPemasukan =   DB::table('tbl_pemasukan')
                ->select('tbl_pemasukan.*','tbl_users.*', 'tbl_iuran.*', 'tbl_jenis_iuran.*', 'tbl_rekening.*', DB::raw('GROUP_CONCAT(tbl_jenis_iuran.jenis_iuran) as jenis_iuran'), DB::raw('GROUP_CONCAT(tbl_iuran.month) as month'))
                ->leftJoin('tbl_iuran','tbl_pemasukan.id_transaction','=','tbl_iuran.id_transaction')
                ->leftJoin('tbl_jenis_iuran', 'tbl_iuran.id_jenis_iuran', '=', 'tbl_jenis_iuran.id')
                ->leftJoin('tbl_users', 'tbl_iuran.id_users', '=', 'tbl_users.id')
                ->leftJoin('tbl_rekening', 'tbl_iuran.to_rekening', '=', 'tbl_rekening.id')
                ->groupBy('tbl_iuran.id_transaction')
                ->get();

        $data['dataPemasukan'] = $dataPemasukan;
        return view('jurnal',$data);
    }
}
