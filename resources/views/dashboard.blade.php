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
                </span> Dashboard
            </h3>
        </div>
        <div class="row">
            <div class="row">
                @if (Session::get('dataUsers')->role === 1)
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                                <h4 class="font-weight-normal mb-3">Data Warga<i
                                        class="mdi mdi-chart-line mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-5">100</h2>
                                <h6 class="card-text">Total Data Warga Perumahan</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                                <h4 class="font-weight-normal mb-3">Pemasukkan <i
                                        class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-5">Rp. 10.000.000</h2>
                                <h6 class="card-text">Total Pemasukkan Perumahan</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-success card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                                <h4 class="font-weight-normal mb-3">Pengeluaran <i
                                        class="mdi mdi-diamond mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-5">Rp. 10.000.000</h2>
                                <h6 class="card-text">Total Pengeluaran Perumahan</h6>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <?php
      if (Session::get('dataUsers')->role == 0) { ?>
            <?php if (Session::get('dataUsers')->number_family_card == null) { ?>
            <div class="alert alert-warning" style="padding: 0; padding-left:20px;padding-top:10px;">
                <p><span class="font-weight-bold">Pemberitahuan!!</span> Silahkan lengkapi data anda terlebih dahulu untuk
                    melanjutkan pembayaran iuran. <a class="btn btn-link btn-fw" href="/profile"> Lengkapi Data</a></p>
            </div>
            <?php } ?>
            <?php if (Session::get('dataUsers')->is_verif == 0 && Session::get('dataUsers')->number_family_card != null) { ?>
            <div class="alert alert-warning" style="padding: 0; padding-left:20px;padding-top:10px;">
                <p><span class="font-weight-bold">Pemberitahuan!!</span> Anda belum dapat melakukan pembayaran iuran, karena
                    data anda belum dikonfirmasi oleh admin kami.</p>
            </div>
            <?php } else { ?>
            <div class="alert alert-success" style="padding: 0; padding-left:20px;padding-top:10px;">
                <p><span class="font-weight-bold">Pemberitahuan!!</span> Silahkan lakukan pembayaran iuran tepat waktu.</p>
            </div>
            <?php } ?>

            <?php } ?>
        </div>
    </div>
@endsection
