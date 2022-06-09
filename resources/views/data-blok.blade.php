<?php

use Illuminate\Support\Facades\Session;
?>
@extends('master')

@section('title-link', 'Beranda')
@section('sub-title-link', 'Beranda')
@section('active', 'beranda')
@section('title', 'Dashboard')
@section('content')
    <div class="content-wrapper" style="padding: 10px 12px 0px 37px;">
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
                        <a href="/data-rumah/data-blok/form?type=create" class="btn btn-primary btn-fw">Tambah Data</a>
                    </div>
                    <table id="table" class="example1 table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Blok</th>
                                <th>No Rumah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($blok as $row)
                                <tr>
                                    <td>{{ $i }}.</td>
                                    <td>{{ $row->blok }}</td>
                                    <td>{{ $row->no_rumah }}</td>
                                    <td>
                                        <a href="/data-rumah/data-blok/form?type=update&id={{ $row->id }}"><button
                                                class="btn btn-gradient-warning btn-rounded btn-icon">
                                                <i class="mdi mdi-table-edit"></i>
                                            </button></a>
                                        <a href="/data-rumah/data-blok/delete/{{ $row->id }}"> <button type="button"
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
            </div>
        </div>

    @endsection
