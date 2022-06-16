<?php

namespace App\Http\Controllers;

use App\Models\ModelBlok;
use App\Models\ModelHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HouseController extends Controller
{

    private $modelBlok;
    private $modelHouse;
    public function __construct(ModelBlok $modelBlok, ModelHouse $modelHouse)
    {
        $this->modelBlok = $modelBlok;
        $this->modelHouse = $modelHouse;
    }

    public function index()
    {
        $data['house'] = $this->modelHouse->select('rumah.*','rumah.id as id_rumah')->leftJoin('blok', 'rumah.blok', '=', 'blok.id')->get();
        
        return view('data-rumah', $data);
    }

    public function destroy($id)
    {
        $data = $this->modelHouse->find($id);
        $data->delete();
        return redirect()->back();
    }

    public function update(Request $request, $id)
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
        $data = $this->modelHouse->find($id);
        $data->update($request->all());
        Session::flash('message', 'Berhasil Edit Data Rumah');
        Session::flash('icon', 'success');
        return redirect()->back();
    }
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
        $this->modelHouse->create($request->all());
        Session::flash('message', 'Berhasil Tambah Data Rumah');
        Session::flash('icon', 'success');
        return redirect()->back();
    }

    public function create()
    {
        $data['blok'] = $this->modelBlok->all();
        $data['house'] = $this->modelHouse->select('*','rumah.id as id_rumah', 'rumah.blok as f_blok')->leftJoin('blok', 'rumah.blok', '=', 'blok.id')->find(request()->id);
        return view("form-data-rumah", $data);
    }

    public function blok()
    {
        $data['blok'] = $this->modelBlok->all();
        return view("data-blok", $data);
    }

    public function deleteBlok($id)
    {
        $data = $this->modelBlok->find($id);
        Session::flash('message', 'Berhasil Hapus Blok');
        Session::flash('icon', 'success');
        $data->delete();
        return redirect()->back();
    }
    public function updateBlok(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'no_rumah' => 'required',
            'blok' => 'required'
        ]);
        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first());
            Session::flash('icon', 'error');
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator);
        }
        $data = $this->modelBlok->find($id);
        $data->update($request->all());
        Session::flash('message', 'Berhasil Update Data Blok');
        Session::flash('icon', 'success');
        return redirect()->back();
    }
    public function blokCreate()
    {
        $data['blok'] = [];
        if (request()->type === "update") {
            $data['blok'] = $this->modelBlok->find(request()->id);
        }
        return view("form-data-blok", $data);
    }

    public function addBlok(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_rumah' => 'required',
            'blok' => 'required'
        ]);
        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first());
            Session::flash('icon', 'error');
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator);
        }
        $this->modelBlok->create($request->all());
        Session::flash('message', 'Berhasil Menambahkan Data Blok');
        Session::flash('icon', 'success');
        return redirect()->back();
    }
}
