<?php

namespace App\Http\Controllers;

use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        $isLogin = Session::get('login');
        if($isLogin == null){
            return redirect('/');
        }
        $dataProfile = ModelUsers::where('id',session::get('dataUsers')->id)->first();
        $data = [
            'dataProfile' => $dataProfile
        ];
        return view('profile',$data);
    }

    public function update(Request $request,$id){
        $validate = Validator::make($request->all(),[
            'firstName' => 'required',
            'lastName'  => 'required',
            'email'  => 'required|email',
            'numberIdentityCard'  => 'required|numeric',
            'numberFamilyCard'  => 'required|numeric',
            'numberOfFamily'  => 'required|numeric',
            'gender'  => 'required',
            'phoneNumber'  => 'required',
        ],[
            'firstName.required'    => "Nama Depan harus dilengkapi",
            'lastName.required'    => "Nama Belakang harus dilengkapi",
            'email.required'    => "Email harus dilengkapi",
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

        $checkSameEmail = ModelUsers::where('email',Session::get('dataUsers')->email)->first();
        if($request->email != $checkSameEmail->email){
            $checkEmailOther = ModelUsers::where('email',$request->email)->first();
            if($checkEmailOther != null){
                Session::flash('message', 'Mohon maaf, email sudah digunakan'); 
                Session::flash('icon', 'error'); 
                return redirect()->back();
            }
        }  


        $imageProfile = $request->file('image');
        $account = ModelUsers::find($id);
        if($imageProfile == null){
            $filename = $account['photo'];
        }else{
            $filename = uniqid() . time() . "."  . explode("/", $imageProfile->getMimeType())[1];
            Storage::disk('uploads')->put('profile/'.$filename,File::get($imageProfile)); 
        }

        if($request->password != null){
            if($request->password != $request->confirmPassword){
                Session::flash('message', 'Password dan konfirmasi password harus sama'); 
                Session::flash('icon', 'error'); 
                return redirect()->back();
            }

            $account->password = Hash::make($request->password);
        }

        $account->first_name = $request->firstName;
        $account->last_name = $request->lastName;
        $account->email = $request->email;
        $account->phone_number = $request->phoneNumber;
        $account->number_identity_card = $request->numberIdentityCard;
        $account->number_family_card = $request->numberFamilyCard;
        $account->number_of_family = $request->numberOfFamily;
        $account->gender = $request->gender;
        $account->photo = $filename;
        $account->blok = $request->blok;
        $account->save();
        Session::put('dataUsers',$account);
        Session::flash('message', 'Berhasil memperbarui data diri.'); 
        Session::flash('icon', 'success'); 
        return redirect()->back();
    }
}
