<?php

namespace App\Http\Controllers;

use App\Models\ModelIuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
}
