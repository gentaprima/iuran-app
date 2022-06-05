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
                </span> Data Rekening
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
                        action="{{ Request::get('type') === 'update' ? '/update-rekening/' . $dataRekening->id : '/add-rekening' }}"
                        method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">No Rekening</label>
                                    <input
                                        value="{{ Request::get('type') === 'update' ? $dataRekening->number_account : '' }}"
                                        required type="number" name="numberAccount" class="form-control"
                                        id="exampleInputUsername1" placeholder="No Rekening">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Nama Pemilik Rekening</label>
                                    <input
                                        value="{{ Request::get('type') === 'update' ? $dataRekening->account_name : '' }}"
                                        required name="accountName" type="text" class="form-control"
                                        id="exampleInputUsername1" placeholder="Nama Pemilik Rekening">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Nama Bank</label>
                                    <input value="{{ Request::get('type') === 'update' ? $dataRekening->bank_name : '' }}"
                                        required name="bankName" type="text" class="form-control"
                                        id="exampleInputUsername1" placeholder="Nama Bank">
                                </div>
                            </div>
                            @csrf
                            <div class="col-md-6 my-auto">
                                <button type="submit" style="width: 100%;height:100%"
                                    class="btn btn-gradient-primary btn-fw">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection