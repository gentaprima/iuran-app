<?php

use Illuminate\Support\Facades\Session;
?>
@extends('master')

@section('title-link', 'Beranda')
@section('sub-title-link', 'Beranda')
@section('active', 'beranda')
@section('title', 'Dashboard')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="padding: 10px 12px 0px 37px;">
        <!-- Content Header (Page header) -->
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Data Jenis Iuran
            </h3>
        </div>
        @if (Session::has('message'))
            <p hidden="true" id="message">{{ Session::get('message') }}</p>
            <p hidden="true" id="icon">{{ Session::get('icon') }}</p>
        @endif
        <div class="row">
            <div class="container-fluid">
                <div class="card p-5 rounded mb-3">
                    <form
                        action="{{ Request::get('type') === 'update' ? '/update-jenis-iuran/' . $iuran->id : '/add-jenis-iuran' }}"
                        method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Jenis Iuran</label>
                                    <input
                                        value="{{ Request::get('type') === 'update' ? $iuran->jenis_iuran : '' }}"
                                        required type="text" name="jenisIuran" class="form-control"
                                        id="exampleInputUsername1" placeholder="Jenis Iuran">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Nominal Pembayaran</label>
                                    <input
                                        value="{{ Request::get('type') === 'update' ? $iuran->nominal : '' }}"
                                        required name="nominal" type="number" class="form-control"
                                        id="exampleInputUsername1" placeholder="Nominal Iuran">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <input type="text" name="keterangan" value="{{ Request::get('type') === 'update' ? $iuran->keterangan : '' }}"  class="form-control">
                                </div>
                            </div>
                            @csrf
                            <div class="col-md-12 my-auto">
                                <button type="submit" style="width: 100%;height:100%"
                                    class="btn btn-gradient-primary btn-fw">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
