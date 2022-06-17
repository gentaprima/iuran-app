<?php

namespace App\Http\Controllers;

use App\Mail\sendEmail;
use App\Models\ModelIuran;
use App\Models\ModelPemasukan;
use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class IuranController extends Controller
{
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nominal'  => 'required|numeric'
        ], [
            'nominal.numeric' => 'Nominal harus angka.'
        ]);

        if ($validate->fails()) {
            Session::flash('message', $validate->errors()->first());
            Session::flash('icon', 'error');
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validate);
        }

        $image = $request->file('image');
        $filename = uniqid() . time() . "."  . explode("/", $image->getMimeType())[1];
        Storage::disk('uploads')->put('bukti/' . $filename, File::get($image));
        $dataUsers = Session::get('dataUsers')->id;

        ModelIuran::create([
            'id_users' => $dataUsers,
            'to_rekening'   => $request->toRekening,
            'nominal'   => $request->nominal,
            'image'   => $filename,
            'is_verif'   => 0,
            'date'  => date('Y-m-d')
        ]);
        Session::flash('message', 'Iuran berhasil dilakukan, Silahkan tunggu verifikasi oleh admin.');
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // $validate = Validator::make($request->all(),[
        //     'nominal'  => 'required|numeric'
        // ],[
        //     'nominal.numeric' => 'Nominal harus angka.'
        // ]);

        // if($validate->fails()){
        //     Session::flash('message', $validate->errors()->first()); 
        //     Session::flash('icon', 'error'); 
        //     return redirect()->back()
        //             ->withInput($request->input())
        //             ->withErrors($validate);
        // }

        $image = $request->file('image');
        $iuran = ModelIuran::where('id_transaction', '=', $id)->first();
        if ($image == null) {
            $filename = $iuran['image'];
        } else {
            $filename = uniqid() . time() . "."  . explode("/", $image->getMimeType())[1];
            Storage::disk('uploads')->put('bukti/' . $filename, File::get($image));
        }
        $iuran->to_rekening = $request->toRekening;
        $iuran->image = $filename;
        $iuran->date = date('Y-m-d');
        $iuran->is_pay = 1;
        $iuran->save();

        Session::flash('message', 'Iuran berhasil diperbarui, Silahkan tunggu verifikasi oleh admin.');
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $iuran = ModelIuran::where('id_transaction', '=', $id);
        $iuran->delete();
        Session::flash('message', 'Iuran berhasil dihapus.');
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function addBill()
    {

        $getDataWarga = DB::table('tbl_users')
            ->where('role', 0)
            ->where('is_verif', 1)
            ->get();
        $dataIuran = [];

        foreach ($getDataWarga as $key => $warga) {
            array_push($dataIuran, [
                'id_transaction' => $idTransaction = 'I-' . random_int(100000, 999999),
                'id_users' => $warga->id,
                'to_rekening' => 1,
                'sub_total' => 80000,
                'month' => date('F'),
                'id_jenis_iuran'    => 1,
                'image' => "",
                'is_verif' => 0,
                'is_pay' => 0,
                'date' => date('Y-m-d'),
            ]);
            Mail::to($warga)->send(new sendEmail($warga));
        }

        DB::table('tbl_iuran')->insert($dataIuran);
        Session::flash('message', 'Notifikasi tagihan berhasil dikirim keseluruh warga.');
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function addIuran(Request $request)
    {

        $dataUsers = Session::get('dataUsers')->id;
        $image = $request->file('image');
        $filename = uniqid() . time() . "."  . explode("/", $image->getMimeType())[1];
        Storage::disk('uploads')->put('bukti/' . $filename, File::get($image));
        $dateMonth = (int)explode('-', $request->month)[1];
        if(isset($request->checkManyMonths)){
            $checkIuran = DB::table('tbl_iuran')->where('month', date('F', mktime(0, 0, 0, $dateMonth, 10)))->where('id_users', $dataUsers)->first();
            if ($checkIuran) {
                Session::flash('message', 'Anda sudah melakukan pembayaran untuk bulan ini.');
                Session::flash('icon', 'warning');
                return redirect()->back();
            }
        }
        if (isset($request->checkManyMonths)) {
            $idTransaction = 'I-' . uniqid();
            for ($i = 0; $i < $request->manyMonths; $i++) {
                DB::table("tbl_iuran")->insert([
                    'id_transaction' => $idTransaction,
                    'id_users' => $dataUsers,
                    'to_rekening' => $request->toRekening,
                    'id_jenis_iuran' => $request->duescategory,
                    'sub_total' => $request->total,
                    'month' => date('F', mktime(0, 0, 0, $dateMonth, 10)),
                    'many_months' => $request->manyMonths,
                    'is_verif'  => 0,
                    'is_pay'  => 1,
                    'image' => $filename,
                    'date' => date('Y-m-d')
                ]);
                $dateMonth += 1;
            }
            Session::flash('message', 'Anda Berhasil Mengirimkan Pembayaran dalam' . $request->manyMonths . "Bulan Seterusnya");
            Session::flash('icon', 'success');
            return redirect()->back();
        }
        $idTransaction = 'I-' . uniqid();
        DB::table("tbl_iuran")->insert([
            'id_transaction' => $idTransaction,
            'id_users' => $dataUsers,
            'to_rekening' => $request->toRekening,
            'id_jenis_iuran' => $request->duescategory,
            'sub_total' => $request->total,
            'month' => date('F', mktime(0, 0, 0, $dateMonth, 10)),
            'many_months' => $request->manyMonths,
            'is_verif'  => 0,
            'is_pay'  => 1,
            'image' => $filename,
            'date' => date('Y-m-d')
        ]);
        Session::flash('message', 'Anda Berhasil Mengirimkan Pembayaran');
        Session::flash('icon', 'success');
        return redirect()->back();
        // if ($request->checkManyMonths == null) {
        //     $dateMonth = (int)explode('-',$request->month)[1];
        //     $dateYear = date('Y');
        //     $checkIuran = DB::table('tbl_iuran')->whereMonth('date', $dateMonth)->whereYear('date', $dateYear)->first();
        //     if ($checkIuran == null) {
        //         $dataInsert = [];
        //         $jenisIuran = DB::table('tbl_jenis_iuran')->get();
        //         $dataJenisIuran = [];
        //         foreach ($jenisIuran as $jenis) {
        //             array_push($dataJenisIuran, (string)$jenis->id);
        //         }
        //         $arrayIuranNotPay = array_values(array_diff($dataJenisIuran, $request->jenisIuran));
        //         //membayar iuran berdasarkan jenis
        //         $idTransaction = 'I-' . random_int(100000, 999999);
        //         for ($i = 0; $i < count($request->jenisIuran); $i++) {
        //             $data = [
        //                 'id_transaction'   => $idTransaction,
        //                 'id_users' => $dataUsers,
        //                 'to_rekening' => $request->toRekening,
        //                 'id_jenis_iuran' => $request->jenisIuran[$i],
        //                 'sub_total' => $request->subTotal ? $request->subTotal : $request->total,
        //                 'image' => $filename,
        //                 'is_verif'  => 0,
        //                 'is_pay'  => 1,
        //                 'month'  => date("F", mktime(0, 0, 0, $dateMonth, 10)),
        //                 'date'  => date('Y-m-d'),
        //             ];
        //             array_push($dataInsert, $data);
        //         }

        //         // insert iuran yang belum dibayar berdasarkan jenis
        //         $idTransactionNotPay = 'I-' . random_int(100000, 999999);
        //         $dataInsertNotPay = [];
        //         for ($i = 0; $i < count($arrayIuranNotPay); $i++) {
        //             $data = [
        //                 'id_transaction'   => $idTransactionNotPay,
        //                 'id_users' => $dataUsers,
        //                 'to_rekening' => $request->toRekening,
        //                 'id_jenis_iuran' => $arrayIuranNotPay[$i],
        //                 'sub_total' => 0,
        //                 'image' => "",
        //                 'is_verif'  => 0,
        //                 'is_pay'  => 0,
        //                 'month'  => date('F'),
        //                 'date'  => date('Y-m-d'),
        //             ];
        //             array_push($dataInsertNotPay, $data);
        //         }
        //         DB::table('tbl_iuran')->insert($dataInsert);
        //         DB::table('tbl_iuran')->insert($dataInsertNotPay);
        //         Session::flash('message', 'Iuran berhasil dibayarkan, silahkan tunggu verifikasi oleh admin.');
        //         Session::flash('icon', 'success');
        //         return redirect()->back();
        //     }else{
        //         if($checkIuran->is_verif == 0 && $checkIuran->is_pay == 1){
        //             Session::flash('message', 'Anda sudah mengajukan pembayaran, silahkan tunggu konfirmasi admin.');
        //             Session::flash('icon', 'warning');
        //         }else if($checkIuran->is_verif == 1 && $checkIuran->is_pay == 1){
        //             Session::flash('message', 'Anda sudah melakukan pembayaran untuk bulan ini.');
        //             Session::flash('icon', 'warning');

        //         }
        //         return redirect()->back();
        //     }
        // } else {
        //     DB::table('tbl_iuran')
        //             ->whereMonth('date',date('m'))
        //             ->whereYear('date',date('Y'))
        //             ->where('id_users',Session::get('dataUsers')->id)
        //             ->where('is_verif',0)
        //             ->delete();
        //     $idTransaction = 'I-' . random_int(100000, 999999);
        //     $monthNumber = (int)explode('-',$request->month)[1];
        //     $jenisIuran = DB::table('tbl_jenis_iuran')->get();
        //     for ($i = 0; $i < $request->manyMonths; $i++) {
        //         $dataInsert = [];
        //         for ($j = 0; $j < count($jenisIuran); $j++) {
        //             $data = [
        //                 'id_transaction'   => $idTransaction,
        //                 'id_users' => $dataUsers,
        //                 'to_rekening' => $request->toRekening,
        //                 'id_jenis_iuran' => $jenisIuran[$j]->id,
        //                 'sub_total' => $request->subTotal,
        //                 'image' => $filename,
        //                 'is_verif'  => 0,
        //                 'is_pay'  => 1,
        //                 'month' =>  date("F", mktime(0, 0, 0, $monthNumber + $i, 10)),
        //                 'date'  => date('Y-m-d'),
        //             ];
        //             array_push($dataInsert, $data);
        //         }
        //         DB::table('tbl_iuran')->insert($dataInsert);
        //     }
        //     Session::flash('message', 'Iuran berhasil dibayarkan, silahkan tunggu verifikasi oleh admin.');
        //     Session::flash('icon', 'success');
        //     return redirect()->back();
        // }
    }

    public function getDataById($id)
    {
        $dataIuran = DB::table('tbl_iuran')
            ->select('tbl_iuran.*', 'tbl_jenis_iuran.*', 'tbl_rekening.*',)
            ->leftJoin('tbl_jenis_iuran', 'tbl_iuran.id_jenis_iuran', '=', 'tbl_jenis_iuran.id')
            ->leftJoin('tbl_users', 'tbl_iuran.id_users', '=', 'tbl_users.id')
            ->leftJoin('tbl_rekening', 'tbl_iuran.to_rekening', '=', 'tbl_rekening.id')
            ->where('id_transaction', '=', $id)
            ->get();
        return response()->json($dataIuran);
    }

    public function confirmIuran($id)
    {
        $dataTransaction = ModelIuran::where('id_transaction', $id)->first();
        $pemasukan = ModelPemasukan::create([
            'id_transaction'    => $id,
            'jumlah'            => $dataTransaction['sub_total'],
            'date'              => date('Y-m-d')
        ]);


        $pemasukan->save();
        $iuran = ModelIuran::where('id_transaction', '=', $id)->update([
            'is_verif' => 1
        ]);
        Session::flash('message', 'Iuran berhasil diverifikasi.');
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function invoice(){
        return view("invoice");
    }
}
