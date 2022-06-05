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
                </span> Data Warga
            </h3>
        </div>
        <div class="row">
            <div class="container-fluid">
                <div class="card p-5 rounded mb-3">
                    <table id="example1" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($dataWarga as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->number_identity_card }}</td>
                                    <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                                    <td>{{ $row->phone_number }}</td>
                                    <td>
                                        <button type="button" class="btn btn-gradient-success btn-rounded btn-icon" data-target="#modal-form" data-toggle="modal">
                                            <i class="mdi mdi-account-card-details"></i>
                                        </button>
                                        <button type="button" class="btn btn-gradient-warning btn-rounded btn-icon">
                                            <i class="mdi mdi-table-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-gradient-danger btn-rounded btn-icon">
                                            <i class="mdi mdi-delete-sweep"></i>
                                        </button>
                                        {{-- <button type="button" data-target="#modal-form" data-toggle="modal"
                                            onclick="viewData('{{ $row->id }}','{{ $row->number_identity_card }}','{{ $row->first_name }}','{{ $row->last_name }}','{{ $row->phone_number }}','{{ $row->number_family_card }}','{{ $row->photo }}','{{ $row->number_of_family }}','{{ $row->gender }}','{{ $row->email }}','{{ $row->blok }}')"
                                            class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i></button>
                                        <button type="button" data-target="#modal-form" data-toggle="modal"
                                            onclick="updateData('{{ $row->id }}','{{ $row->number_identity_card }}','{{ $row->first_name }}','{{ $row->last_name }}','{{ $row->phone_number }}','{{ $row->number_family_card }}','{{ $row->photo }}','{{ $row->number_of_family }}','{{ $row->gender }}','{{ $row->email }}','{{ $row->blok }}')"
                                            class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></button>
                                        <button type="button" data-target="#modal-delete" data-toggle="modal"
                                            onclick="deleteData('{{ $row->id }}')" class="btn btn-secondary btn-sm"><i
                                                class="fa fa-trash"></i></button> --}}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
@endsection
