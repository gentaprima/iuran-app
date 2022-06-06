<?php

namespace App\Http\Controllers;

use App\Models\ModelJenisIuran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class JenisIuranController extends Controller
{
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nominal'   => 'required|numeric'
        ], [
            'nominal.numeric'   => "Nominal Pembayaran harus angka."
        ]);

        if ($validate->fails()) {
            Session::flash('message', $validate->errors()->first());
            Session::flash('icon', 'error');
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validate);
        }

        $jenisIuran = ModelJenisIuran::create([
            'jenis_iuran'   => $request->jenisIuran,
            'nominal'   => $request->nominal
        ]);
        $jenisIuran->save();
        Session::flash('message', 'Berhasil menambahkan data jenis iuran.');
        Session::flash('icon', 'success');
        return redirect()->back();
    }
    public function create()
    {
        return view("form-jenis-iuran");
    }

    public function show($id)
    {
        $data['iuran'] = ModelJenisIuran::find($id);
        
        return view("form-jenis-iuran", $data);
    }
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'nominal'   => 'required|numeric'
        ], [
            'nominal.numeric'   => "Nominal Pembayaran harus angka."
        ]);

        if ($validate->fails()) {
            Session::flash('message', $validate->errors()->first());
            Session::flash('icon', 'error');
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validate);
        }

        $jenisIuran = ModelJenisIuran::find($id);
        $jenisIuran->nominal = $request->nominal;
        $jenisIuran->jenis_iuran = $request->jenisIuran;
        $jenisIuran->save();
        Session::flash('message', 'Berhasil memperbarui data jenis iuran');
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $jenisIuran = ModelJenisIuran::find($id);
        $jenisIuran->delete();
        Session::flash('message', 'Berhasil menghapus data jenis iuran.');
        Session::flash('icon', 'success');
        return redirect()->back();
    }
}
