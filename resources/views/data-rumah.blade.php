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
                </span> Data Rumah
            </h3>
        </div>
        <div class="row">
            <div class="container-fluid">
                <div class="card p-5 rounded mb-3">
                    <div class="col-sm-12 col-lg">
                        <a href="/data-rumah/form?type=create" class="btn btn-gradient-primary btn-fw">Tambah Data</a>
                    </div>
                    <!-- <button class="btn btn-outline-primary size-btn" onclick="addData()" data-toggle="modal" data-target="#modal-form">Tambah Data</button> -->
                    <table id="example1" class="example1 table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kepemilikan</th>
                                <th>No Rumah - Blok</th>
                                <th>Status Tempat Tinggal</th>
                                <th>Tahun Ditempati</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($house as $row)
                                <tr>
                                    <td>
                                        {{ $i }}.
                                    </td>
                                    <td>
                                        {{ $row->atas_nama }}
                                    </td>
                                    <td>
                                        {{ $row->no_rumah . ' - ' . $row->blok }}
                                    </td>
                                    <td>
                                        @php
                                            $status = ($row->status == 0 ? 'Rumah Kosong' : $row->status == 1) ? 'Rumah Dijual' : 'Rumah Terisi';
                                        @endphp
                                        {{ $status }}
                                    </td>
                                    <td>
                                        {{ $row->tahun }}
                                    </td>
                                    <td>
                                        <a href="/data-rumah/form?type=update&id={{ $row->id_rumah }}"><button
                                                class="btn btn-gradient-warning btn-rounded btn-icon">
                                                <i class="mdi mdi-table-edit"></i>
                                            </button></a>
                                        <a href="/data-rumah/delete/{{ $row->id }}"> <button type="button"
                                                class="btn btn-gradient-danger btn-rounded btn-icon">
                                                <i class="mdi mdi-delete-sweep"></i>
                                            </button></a>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
@endsection
