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
                    <!-- <button class="btn btn-outline-primary size-btn" onclick="addData()" data-toggle="modal" data-target="#modal-form">Tambah Data</button> -->
                    <table id="example1" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID transaksi</th>
                                <th>Nama</th>
                                <th>Nominal Pembayaran</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataIuran as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->id_transaction }}</td>
                                    <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                                    <td>@php echo number_format($row->sub_total, 2, ".", ","); @endphp</td>

                                    <td>
                                        <?php if ($row->is_verif == 0) {  ?>
                                        <p class="badge badge-warning">Belum Diverikasi</p>
                                        <?php } else { ?>
                                        <p class="badge badge-success">Sudah Diverikasi</p>
                                        <?php } ?>

                                    </td>
                                    <?php if ($row->is_pay == 1) { ?>
                                    <td>{{ $row->date }}</td>
                                    <?php } else { ?>
                                    <td>-</td>
                                    <?php } ?>
                                    <td>
                                        <button type="button" data-target="#modal-form" data-toggle="modal"
                                            onclick="updateData('{{ $row->id_transaction }}','{{ $row->id_users }}',`{{ asset('') }}`)"
                                            class="btn btn-secondary btn-sm mt-1"><i class="fa fa-eye"></i></button>
                                        <?php if ($row->is_verif == 0) { ?>
                                        <button type="button" data-target="#modal-check"
                                            onclick="confirmData('{{ $row->id_transaction }}')" data-toggle="modal"
                                            class="btn btn-secondary btn-sm mt-1"><i class="fa fa-check"></i></button>
                                        <button type="button" data-target="#modal-delete" data-toggle="modal"
                                            onclick="deleteData('{{ $row->id_transaction }}')"
                                            class="btn btn-secondary btn-sm mt-1"><i class="fa fa-trash"></i></button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
