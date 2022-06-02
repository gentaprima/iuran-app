<?php

namespace App\Http\Controllers;

use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class WargaController extends Controller
{

    public function index()
    {
        //
    }

    public function verifData($id){
        $warga = ModelUsers::find($id);
        $warga->is_verif= 1;
        $warga->save();
        Session::flash('message', 'Berhasil mengkonfirmasi data warga.'); 
        Session::flash('icon', 'success'); 
        return redirect()->back();
    }    

    public function update(Request $request,$id){
        $validate = Validator::make($request->all(),[
            'firstName' => 'required',
            'lastName'  => 'required',
            'numberIdentityCard'  => 'required|numeric',
            'numberFamilyCard'  => 'required|numeric',
            'numberOfFamily'  => 'required|numeric',
            'gender'  => 'required',
            'phoneNumber'  => 'required',
        ],[
            'firstName.required'    => "Nama Depan harus dilengkapi",
            'lastName.required'    => "Nama Belakang harus dilengkapi",
            'numberIndentityCard.required'    => "NIK harus dilengkapi",
            'numberIndentityCard.numeric'    => "NIK harus angka",
            'numberFamilyCard.required'    => "Nomor Kartu Keluarga harus dilengkapi",
            'numberFamilyCard.numeric'    => "Nomor Kartu Keluarga harus angka",
            'numberOfFamily.required'    => "Jumlah Anggota Keluarga Keluarga harus dilengkapi",
            'numberOfFamily.numeric'    => "Jumlah Anggota Keluarga Keluarga harus angka",
            'gender.required'    => "Jenis kelamin harus dilengkapi",
            'phoneNumber.required'    => "Nomor Telepon harus dilengkapi"
        ]);

        if($validate->fails()){
            Session::flash('message', $validate->errors()->first()); 
            Session::flash('icon', 'error'); 
            return redirect()->back()
                    ->withInput($request->input())
                    ->withErrors($validate);
        }


       
        $account = ModelUsers::find($id);
        $account->first_name = $request->firstName;
        $account->last_name = $request->lastName;
        $account->phone_number = $request->phoneNumber;
        $account->number_identity_card = $request->numberIdentityCard;
        $account->number_family_card = $request->numberFamilyCard;
        $account->number_of_family = $request->numberOfFamily;
        $account->gender = $request->gender;
        $account->save();
        Session::flash('message', 'Berhasil memperbarui data warga.'); 
        Session::flash('icon', 'success'); 
        return redirect()->back();
    }

    public function destroy($id){
        $account = ModelUsers::find($id);
        $account->delete();
        Session::flash('message', 'Berhasil menghapus data warga.'); 
        Session::flash('icon', 'success'); 
        return redirect()->back();
    }

    public function getDataById($id){
        $data = ModelUsers::find($id);
        return response()->json($data);
    }
}
