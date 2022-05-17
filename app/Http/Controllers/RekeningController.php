<?php

namespace App\Http\Controllers;

use App\Models\ModelRekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isLogin = Session::get('login');
        if($isLogin == null){
            return redirect('/');
        }
        $dataRekening = ModelRekening::all();
        $data = [
            'dataRekening' => $dataRekening
        ];
        return view('data-rekening',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'numberAccount' => 'required|numeric',
            'accountName'  => 'required',
            'bankName'      => 'required'
        ],[
            'numberAccount.required' => 'Nomor Rekening harus dilengkapi',
            'numberAccount.numeric' => 'Nomor Rekening harus angka',
            'accountName.required' => 'Nama Pemilik Rekening harus dilengkapi',
            'bankName.required' => 'Nama Bank harus dilengkapi',
        ]);

        if($validate->fails()){
            Session::flash('message', $validate->errors()->first()); 
            Session::flash('icon', 'error'); 
            return redirect()->back()
                    ->withInput($request->input())
                    ->withErrors($validate);
        }

        $rekening = ModelRekening::create([
            'number_account'    => $request->numberAccount,
            'bank_name'         => $request->bankName,
            'account_name'         => $request->accountName,
        ]);
        $rekening->save();
        Session::flash('message', 'Berhasil menambahkan data rekening'); 
        Session::flash('icon', 'success'); 
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(),[
            'numberAccount' => 'required|numeric',
            'accountName'  => 'required',
            'bankName'      => 'required'
        ],[
            'numberAccount.required' => 'Nomor Rekening harus dilengkapi',
            'numberAccount.numeric' => 'Nomor Rekening harus angka',
            'accountName.required' => 'Nama Pemilik Rekening harus dilengkapi',
            'bankName.required' => 'Nama Bank harus dilengkapi',
        ]);

        if($validate->fails()){
            Session::flash('message', $validate->errors()->first()); 
            Session::flash('icon', 'error'); 
            return redirect()->back()
                    ->withInput($request->input())
                    ->withErrors($validate);
        }

        $rekening = ModelRekening::find($id);
        $rekening->number_account = $request->numberAccount;
        $rekening->bank_name = $request->bankName;
        $rekening->account_name = $request->accountName;
        $rekening->save();
        Session::flash('message', 'Berhasil memperbarui data rekening'); 
        Session::flash('icon', 'success'); 
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rekening = ModelRekening::find($id);
        $rekening->delete();
        Session::flash('message', 'Berhasil menghapus data rekening'); 
        Session::flash('icon', 'success'); 
        return redirect()->back();
        
    }
}
