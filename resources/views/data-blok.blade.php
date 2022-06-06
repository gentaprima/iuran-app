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
                </span> Data Blok
            </h3>
        </div>
        <div class="row">
            <div class="container-fluid">
                <div class="card p-5 rounded mb-3">
                    <div class="col-sm-12 col-lg">
                        <button class="btn btn-primary btn-fw" onclick="addData()" data-toggle="modal"
                            data-target="#modal-form">Tambah Data</button>
                    </div>
                    <!-- <button class="btn btn-outline-primary size-btn" onclick="addData()" data-toggle="modal" data-target="#modal-form">Tambah Data</button> -->
                    <table id="example1" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Blok</th>
                                <th>No Rumah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
