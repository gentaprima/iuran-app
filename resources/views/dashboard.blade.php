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
            @if (Session::get('dataUsers')->role === 1)
                <?php if ($dataIuran == null) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    Silahkan klik tombol untuk tagih iuran bulan ini kepada warga
                                </div>
                                <div class="col-md-6">
                                    <button type="button" data-toggle="modal" data-target="#modal-form"
                                        style="float: right;" class="btn btn-gradient-primary">Tagih Iuran</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                                <h4 class="font-weight-normal mb-3">Data Warga<i
                                        class="mdi mdi-chart-line mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-5">{{ $dataWarga }}</h2>
                                <h6 class="card-text">Total Data Warga</h6>
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
                                <h2 class="mb-5">Rp. {{ number_format($dataPemasukan, 2, '.', ',') }}</h2>
                                <h6 class="card-text">Total Pemasukkan</h6>
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
                                <h2 class="mb-5">Rp. {{ number_format($dataPengeluaran, 2, '.', ',') }}</h2>
                                <h6 class="card-text">Total Pengeluaran</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <canvas id="myChart" class="bg-white px-5 py-5"></canvas>
                    </div>
            @endif
        </div>

        <?php
        if (Session::get('dataUsers')->role == 0) { ?>
        <h3 class="py-2 alert" style="background-color: #9F57FF;text-color:white">Selamat Datang,
            {{ strtoupper(Session::get('dataUsers')->first_name . ' ' . Session::get('dataUsers')->last_name) }}</h3>
        <?php if (Session::get('dataUsers')->id_rumah == null) { ?>
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
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tagih Iuran</h5>
                    <button type="button" class="btn btn-gradient-primary close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Anda yakin ingin memulai tagihan untuk bulan ini?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <a href="/tagih-iuran" type="submit" class="btn btn-gradient-primary">Proses</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
        var xValues = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"];
        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    label: 'Pengeluaran',
                    backgroundColor: "#E91E63",
                    data: {{ $chartDataOut }},
                    borderColor: "#E91E63",
                    fill: false,
                }, {
                    label: 'Pemasukkan',
                    backgroundColor: "#46c35f",
                    data: {{ $chartDataIn }},
                    borderColor: "#46c35f",
                    fill: false,
                }]
            },
            options: {
                legend: {
                    display: true
                }
            }
        });
    </script>
@endsection
