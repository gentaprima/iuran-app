<?php

namespace App\Http\Controllers;

use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        $isLogin = Session::get('login');
        if ($isLogin != null) {
            return redirect('/home');
        }
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function auth(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password'  => 'required'
        ], [
            'email.required' => "Email harus dilengkapi",
            'password.required' => "Password harus dilengkapi"
        ]);

        if ($validate->fails()) {
            Session::flash('message', $validate->errors()->first());
            Session::flash('icon', 'error');
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validate);
        }

        $checkUsers = ModelUsers::where('email', $request->email)->first();

        if ($checkUsers == null) {
            Session::flash('message', 'Mohon maaf, Akun tidak ditemukan.');
            Session::flash('icon', 'error');
            return redirect()->back()
            ->withInput($request->input());
        }
        
        if (!Hash::check($request->password, $checkUsers->password)) {

            Session::flash('message', 'Mohon maaf, Email atau Password tidak sesuai.');
            Session::flash('icon', 'error');
            
            return redirect()->back()
                ->withInput($request->input());
        }

        Session::put('dataUsers', $checkUsers);
        Session::put('login', true);
        return redirect('/home');
    }

    public function proccesRegister(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'firstName'    => 'required',
            'lastName'    => 'required',
            'email'    => 'required|email',
            'phoneNumber'    => 'required|numeric|min:11',
            'password'    => 'required_with:confirmPassword|same:confirmPassword',
            'confirmPassword'    => 'required',
            'nik'           => 'required|numeric'

        ], [
            'firstName.required' => "Nama Depan harus dilengkapi",
            'lastName.required' => "Nama Belakang harus dilengkapi",
            'email.required' => "Email harus dilengkapi",
            'password.required' => "Password harus dilengkapi",
            'confirm.required' => "Password harus dilengkapi",
            'phoneNumber.numeric'       => "Nomor telepon harus menggunakan angka",
            'nik.numeric'       => "NIK harus menggunakan angka",
            'phoneNumber.min'       => "Nomor telepon minimal 11 angka",
            'passwird.confirmed'       => "Password dan Konfirmasi password harus sama",
        ]);

        if ($validate->fails()) {
            Session::flash('message', $validate->errors()->first());
            Session::flash('icon', 'error');
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validate);
        }

        $checkUsers = ModelUsers::where('email', $request->email)->first();
        if ($checkUsers != null) {
            Session::flash('message', 'Mohon maaf, Email sudah digunakan.');
            Session::flash('icon', 'error');
            return redirect()->back();
        }

        $users = ModelUsers::create([
            'number_identity_card' => $request->nik,
            'email' => $request->email,
            'first_name'    => $request->firstName,
            'last_name'    => $request->lastName,
            'email'    => $request->email,
            'phone_number'    => $request->phoneNumber,
            'password'    => Hash::make($request->password),
            'role'         => 0,
            'is_verif'         => 0
        ]);
        $users->save();
        Session::flash('message', 'Berhasil membuat akun, Silahkan login.');
        Session::flash('icon', 'success');
        
        return redirect()->back();
    }
}
