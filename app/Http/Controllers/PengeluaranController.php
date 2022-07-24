<?php

namespace App\Http\Controllers;

use App\Models\ModelPengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isLogin = Session::get('login');
        $data['pengeluaran'] = ModelPengeluaran::where('tipe_pengeluaran',0)->get();
        $data['jenis_pengeluaran'] = DB::table("jenis_pengeluaran")->where('tipe_pengeluaran','=',0)->get();
        
        return view("data-pengeluaran", $data);
    }

    public function indexTTP(){
        $data['pengeluaran'] = ModelPengeluaran::where('tipe_pengeluaran',1)->get();
        $data['jenis_pengeluaran'] = DB::table("jenis_pengeluaran")->where("tipe_pengeluaran",'=',1)->get();
        return view("data-pengeluaran-ttp",$data);
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
        $validator = Validator::make($request->all(), [
            '*' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first());
            Session::flash('icon', 'error');
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator);
        }
        $input = $request->all();
        $input['id_transaksi'] = "I-" . uniqid();
        $input['tipe_pengeluaran'] = !isset($input['tipe_pengeluaran']) ? 0 :1;
        ModelPengeluaran::create($input);
        Session::flash('message', 'Berhasil Tambah Data Anggaran');
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        ModelPengeluaran::where("id_transaksi",$id)->update([
            'status'=> $request->status,
            'is_action'=>1
        ]);
        if($request->status == 2){
            Session::flash('message', 'Berhasil Menolak Data Anggaran');
            Session::flash('icon', 'error');
        }else{
            Session::flash('message', 'Berhasil Menerima Data Anggaran');
            Session::flash('icon', 'success');
        }
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
        //
    }
}
