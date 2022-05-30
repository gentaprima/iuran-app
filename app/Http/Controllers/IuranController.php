<?php

namespace App\Http\Controllers;

use App\Mail\sendEmail;
use App\Models\ModelIuran;
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
    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            'nominal'  => 'required|numeric'
        ],[
            'nominal.numeric' => 'Nominal harus angka.'
        ]);

        if($validate->fails()){
            Session::flash('message', $validate->errors()->first()); 
            Session::flash('icon', 'error'); 
            return redirect()->back()
                    ->withInput($request->input())
                    ->withErrors($validate);
        }

        $image = $request->file('image');
        $filename = uniqid() . time() . "."  . explode("/", $image->getMimeType())[1];
        Storage::disk('uploads')->put('bukti/'.$filename,File::get($image)); 
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

    public function update(Request $request,$id){
        $validate = Validator::make($request->all(),[
            'nominal'  => 'required|numeric'
        ],[
            'nominal.numeric' => 'Nominal harus angka.'
        ]);

        if($validate->fails()){
            Session::flash('message', $validate->errors()->first()); 
            Session::flash('icon', 'error'); 
            return redirect()->back()
                    ->withInput($request->input())
                    ->withErrors($validate);
        }

        $image = $request->file('image');
        $iuran = ModelIuran::find($id);
        if($image == null){
            $filename = $iuran['image'];
        }else{
            $filename = uniqid() . time() . "."  . explode("/", $image->getMimeType())[1];
            Storage::disk('uploads')->put('bukti/'.$filename,File::get($image)); 
        }
        $iuran->to_rekening = $request->toRekening;
        $iuran->nominal = $request->nominal;
        $iuran->image = $filename;
        $iuran->date = date('Y-m-d');
        $iuran->is_pay = 1;
        $iuran->save();

        Session::flash('message', 'Iuran berhasil diperbarui, Silahkan tunggu verifikasi oleh admin.'); 
        Session::flash('icon', 'success'); 
        return redirect()->back();
    }

    public function destroy($id){
        $iuran = ModelIuran::find($id);
        $iuran->delete();
        Session::flash('message', 'Iuran berhasil dihapus.'); 
        Session::flash('icon', 'success'); 
        return redirect()->back();
    }

    public function addBill(){
        $getDataWarga = DB::table('tbl_users')
                            ->where('role',0)
                            ->where('is_verif',1)
                            ->get();
        $dataIuran = [];
    
        foreach($getDataWarga as $key => $warga){
            array_push($dataIuran,[
                'id_users' => $warga->id,
                'to_rekening' => 1,
                'nominal' => 0,
                'image' => "",
                'is_verif' => 0,
                'is_pay' => 0,
                'date' => date('Y-m-d'),
            ]);
            Mail::to($warga)->send(New sendEmail($warga));
        }

        DB::table('tbl_iuran')->insert($dataIuran);
        Session::flash('message', 'Notifikasi tagihan berhasil dikirim keseluruh warga.'); 
        Session::flash('icon', 'success'); 
        return redirect()->back();
    }
}
