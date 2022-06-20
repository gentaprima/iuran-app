<?php

namespace App\Http\Controllers;

use App\Models\ModelHouse;
use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $isLogin = Session::get('login');
        if ($isLogin == null) {
            return redirect('/');
        }
        $dataRumah = ModelHouse::select('rumah.*','rumah.id as rumah_id', 'blok.*', 'blok.id as id_blok')->join("blok", 'rumah.blok', '=', 'blok.id')->get();
        $dataProfile = ModelUsers::select('rumah.*','blok.*','tbl_users.*', 'tbl_users.id as id_user')
                                ->leftJoin('rumah', 'tbl_users.id_rumah', '=', 'rumah.id')
                                ->leftJoin("blok", 'rumah.blok', '=', 'blok.id')
                                ->where('tbl_users.id', session::get('dataUsers')->id)->first();
        // return $dataProfile;
        $data = [
            'dataProfile' => $dataProfile,
            'dataRumah' => $dataRumah
        ];
        return view('profile', $data);
    }

    public function update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName'  => 'required',
            'email'  => 'required|email',
            'numberIdentityCard'  => 'required|numeric',
            'id_rumah' => 'required|numeric',
            'gender'  => 'required',
            'phoneNumber'  => 'required',
        ], [
            'firstName.required'    => "Nama Depan harus dilengkapi",
            'lastName.required'    => "Nama Belakang harus dilengkapi",
            'email.required'    => "Email harus dilengkapi",
            'numberIndentityCard.required'    => "NIK harus dilengkapi",
            'numberIndentityCard.numeric'    => "NIK harus angka",
            'gender.required'    => "Jenis kelamin harus dilengkapi",
            'phoneNumber.required'    => "Nomor Telepon harus dilengkapi",
            'id_rumah.required' => "No Rumah - Blok Harus Diisi"
        ]);

        if ($validate->fails()) {
            Session::flash('message', $validate->errors()->first());
            Session::flash('icon', 'error');
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validate);
        }
        $checkSameEmail = ModelUsers::where('email', Session::get('dataUsers')->email)->first();
        if ($request->email != $checkSameEmail->email) {
            $checkEmailOther = ModelUsers::where('email', $request->email)->first();
            if ($checkEmailOther != null) {
                Session::flash('message', 'Mohon maaf, email sudah digunakan');
                Session::flash('icon', 'error');
                return redirect()->back();
            }
        }


        $imageProfile = $request->file('image');

        $account = ModelUsers::find(Session::get("dataUsers")->id);
        if ($imageProfile == null) {
            $filename = $account['photo'];
        } else {
            $filename = uniqid() . time() . "."  . explode("/", $imageProfile->getMimeType())[1];
            Storage::disk('uploads')->put('profile/' . $filename, File::get($imageProfile));
        }

        if ($request->password != null) {
            if ($request->password != $request->confirmPassword) {
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
        $account->gender = $request->gender;
        $account->photo = $filename;
        $account->id_rumah = $request->id_rumah;
        
        $account->save();
        Session::put('dataUsers', $account);
        Session::flash('message', 'Berhasil memperbarui data diri.');
        Session::flash('icon', 'success');
        return redirect()->back();
    }
}
