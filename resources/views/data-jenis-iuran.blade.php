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
        <div class="row">
            <div class="container-fluid">
                <div class="card p-5 rounded mb-3">
                    <div class="col-sm-12 col-lg">
                        <!-- <a href="/jenis-iuran/form-jenis-iuran" class="btn btn-primary btn-fw">Tambah Data</a> -->
                    </div>
                    <table id="example1" class="example1 table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Iuran</th>
                                <th>Nominal Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataJenis as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->jenis_iuran }}</td>
                                    <td>Rp @php echo number_format($row->nominal, 2, ".", ","); @endphp</td>
                                    <td>
                                        <a href="/jenis-iuran/form-update/{{ $row->id }}?type=update"><button
                                                type="button" class="btn btn-gradient-warning btn-rounded btn-icon">
                                                <i class="mdi mdi-table-edit"></i>
                                            </button></a>
                                        <a href="/delete-jenis-iuran/{{ $row->id }}"> <button type="button"
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
