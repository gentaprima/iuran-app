<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurnalController extends Controller
{
    public function index()
    {
        $request = request();
        $dataPemasukan =   DB::table('tbl_pemasukan')
            ->select(
                'rumah.*',
                'blok.*',
                'tbl_pemasukan.id as kode',
                'tbl_pemasukan.*',
                'tbl_users.*',
                'tbl_iuran.*',
                'tbl_jenis_iuran.*',
                'tbl_rekening.*',
                DB::raw('GROUP_CONCAT(tbl_jenis_iuran.jenis_iuran) as jenis_iuran'),
                DB::raw('GROUP_CONCAT(tbl_iuran.month) as month')
            )
            ->join('tbl_iuran', 'tbl_pemasukan.id_transaction', '=', 'tbl_iuran.id_transaction')
            ->join('tbl_jenis_iuran', 'tbl_iuran.id_jenis_iuran', '=', 'tbl_jenis_iuran.id')
            ->join('tbl_users', 'tbl_iuran.id_users', '=', 'tbl_users.id')
            ->leftJoin('rumah', 'tbl_users.id_rumah', '=', 'rumah.id')
            ->leftJoin("blok", 'rumah.blok', '=', 'blok.id')
            ->join('tbl_rekening', 'tbl_iuran.to_rekening', '=', 'tbl_rekening.id')
            ->groupBy('tbl_iuran.id_transaction');
        if ($request->date) {
            $splitDate = explode("-", $request->date);
            $dataPemasukan->whereRaw('YEAR(tbl_iuran.date) = ' . $splitDate[0])->whereRaw('MONTH(tbl_iuran.date) = ' . $splitDate[1]);
        }
        $dataPemasukan = $dataPemasukan->get();
        $dataPengeluaran = DB::table("pengeluaran")->where('status', 1);
        if ($request->date) {
            $splitDate = explode("-", $request->date);
            $dataPengeluaran->whereRaw('YEAR(tanggal_pengeluaran) = ' . $splitDate[0])->whereRaw('MONTH(tanggal_pengeluaran) = ' . $splitDate[1]);
        }
        $dataPengeluaran = $dataPengeluaran->get();
        $data['dataPemasukan'] = $dataPemasukan;
        $data['dataPengeluaran'] = $dataPengeluaran;
        $data['totalMasuk'] = $dataPemasukan->sum("sub_total");
        return view('jurnal', $data);
    }


    public function print()
    {
        $request = request();
        $dataPemasukan =   DB::table('tbl_pemasukan')
            ->select(
                'rumah.*',
                'blok.*',
                'tbl_pemasukan.id as kode',
                'tbl_pemasukan.*',
                'tbl_users.*',
                'tbl_iuran.*',
                'tbl_jenis_iuran.*',
                'tbl_rekening.*',
                DB::raw('GROUP_CONCAT(tbl_jenis_iuran.jenis_iuran) as jenis_iuran'),
                DB::raw('GROUP_CONCAT(tbl_iuran.month) as month')
            )
            ->join('tbl_iuran', 'tbl_pemasukan.id_transaction', '=', 'tbl_iuran.id_transaction')
            ->join('tbl_jenis_iuran', 'tbl_iuran.id_jenis_iuran', '=', 'tbl_jenis_iuran.id')
            ->join('tbl_users', 'tbl_iuran.id_users', '=', 'tbl_users.id')
            ->leftJoin('rumah', 'tbl_users.id_rumah', '=', 'rumah.id')
            ->leftJoin("blok", 'rumah.blok', '=', 'blok.id')
            ->join('tbl_rekening', 'tbl_iuran.to_rekening', '=', 'tbl_rekening.id')
            ->groupBy('tbl_iuran.id_transaction');
        if ($request->date) {
            $splitDate = explode("-", $request->date);
            $dataPemasukan->whereRaw('YEAR(tbl_iuran.date) = ' . $splitDate[0])->whereRaw('MONTH(tbl_iuran.date) = ' . $splitDate[1]);
        }
        $dataPemasukan = $dataPemasukan->get();
        $dataPengeluaran = DB::table("pengeluaran")->where('status', 1);
        if ($request->date) {
            $splitDate = explode("-", $request->date);
            $dataPengeluaran->whereRaw('YEAR(tanggal_pengeluaran) = ' . $splitDate[0])->whereRaw('MONTH(tanggal_pengeluaran) = ' . $splitDate[1]);
        }
        $dataPengeluaran = $dataPengeluaran->get();
        $data['dataPemasukan'] = $dataPemasukan;
        $data['dataPengeluaran'] = $dataPengeluaran;
        $data['totalMasuk'] = $dataPemasukan->sum("sub_total");
        $pdf = Pdf::loadView('print-out-report', $data)->setPaper('a4', 'landscape');
        return $pdf->download(date('m-d-Y hsi'  ) . '.pdf');
        // return view('print-out-report',$data);
    }
}
