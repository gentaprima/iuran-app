<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function index()
    {
        return view('data-rumah');
    }


    public function create()
    {
        return view("form-data-rumah");
    }

    public function blok()
    {
        return view("data-blok");
    }

    public function blokCreate()
    {
        return view("form-data-blok");
    }
}
