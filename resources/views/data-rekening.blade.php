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
        <div class="row">
            <div class="container-fluid">
                <div class="card p-5 rounded mb-3">
                    <div class="col-sm-12 col-lg">
                        <a href="/rekening/form-tambah-rekening" class="btn btn-primary btn-fw">Tambah Data</a>
                    </div>
                    <table id="example1" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Rekening</th>
                                <th>Nama</th>
                                <th>Bank</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataRekening as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->number_account }}</td>
                                    <td>{{ $row->account_name }}</td>
                                    <td>{{ $row->bank_name }}</td>
                                    <form action="/rekening/form-update/{{ $row->id }}" method="get">
                                        <td>
                                            <input type="hidden" name="type" value="update">
                                            <button class="btn btn-gradient-warning btn-rounded btn-icon">
                                                <i class="mdi mdi-table-edit"></i>
                                            </button>
                                    </form>
                                    <a href="/delete-rekening/{{ $row->id }}"><button type="button"
                                            class="btn btn-gradient-danger btn-rounded btn-icon">
                                            <i class="mdi mdi-delete-sweep"></i>
                                        </button></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    @endsection
