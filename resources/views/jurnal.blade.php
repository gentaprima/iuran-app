<?php

use Illuminate\Support\Facades\Session;
?>
@extends('master')

@section('title-link', 'Jurnal')
@section('sub-title-link', 'Jurnal')
@section('active', 'beranda')
@section('title', 'Jurnal')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding: 10px 12px 0px 37px;">
    <!-- Content Header (Page header) -->
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Jurnal Pemasukan dan Pengeluaran
        </h3>
    </div>
    <div class="row">
        <div class="container-fluid">
            <div class="card p-5 rounded mb-3">
                <div class="row">
                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-center pt-2 pb-2">Pemasukan</h5>
                                <hr>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dataPemasukan as $row)
                                        @php
                                        $jenisIuran = $row->keterangan;
                                        $splitIuran = explode(',', $jenisIuran);
                                        $month = $row->month;
                                        $splitMonth = explode(',', $month);
                                        @endphp
                                        <tr>
                                            <td>{{$row->date}}</td>
                                            <td>{{$row->first_name}} {{$row->last_name}}</td>
                                            <td>
                                                iuran bulan  <?php for ($i = 0; $i < count($splitMonth); $i++) { ?>
                                                                <?php if($splitMonth[count($splitMonth) - 1] == $i){ ?>

                                                               <span class="font-weight-bold"> <?= $splitMonth[$i] ?>, </span>
                                                               <?php }else{?>
                                                                <span class="font-weight-bold"> <?= $splitMonth[$i] ?></span>
                                                               <?php }?>
                                                            <?php } ?>
                                                <hr>
                                                <ul>
                                                    <?php for ($i = 0; $i < count($splitIuran); $i++) { ?>
                                                        <li><?= $splitIuran[$i] ?></li>
                                                    <?php } ?>
                                                </ul>
                                            </td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4">Total Saldo</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-center pt-2 pb-2">Pengeluaran</h5>
                                <hr>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3">Total Saldo</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <!-- <div class="row">
                                    <div class="col-md-4">Tanggal</div>
                                    <div class="col-md-4">Keterangan</div>
                                    <div class="col-md-4">Jumlah</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Total Saldo</h5>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div> -->
                            </div>

                        </div>

                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
</div>
@endsection