<?php

use Illuminate\Support\Facades\Session;
?>
@extends('master')

@section('title-link','Beranda')
@section('sub-title-link','Beranda')
@section('active','beranda')
@section('title','Dashboard')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding: 10px 12px 0px 37px;">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Beranda</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <?php
      if (Session::get('dataUsers')->role == 0) { ?>
        <?php if (Session::get('dataUsers')->number_family_card == null) { ?>
          <div class="alert alert-warning" style="padding: 0; padding-left:20px;padding-top:10px;">
            <p><span class="font-weight-bold">Pemberitahuan!!</span> Silahkan lengkapi data anda terlebih dahulu untuk melanjutkan pembayaran iuran. <a href="/profile"> Lengkapi Data</a></p>
          </div>
        <?php } ?>
        <?php if (Session::get('dataUsers')->is_verif == 0 && Session::get('dataUsers')->number_family_card != null) { ?>
          <div class="alert alert-warning" style="padding: 0; padding-left:20px;padding-top:10px;">
            <p><span class="font-weight-bold">Pemberitahuan!!</span> Anda belum dapat melakukan pembayaran iuran, karena data anda belum dikonfirmasi oleh admin kami.</p>
          </div>
        <?php } else { ?>
          <div class="alert alert-success" style="padding: 0; padding-left:20px;padding-top:10px;">
            <p><span class="font-weight-bold">Pemberitahuan!!</span> Silahkan lakukan pembayaran iuran tepat waktu.</p>
          </div>
        <?php } ?>

      <?php } ?>
      <?php
      if (Session::get('dataUsers')->role == 1) { ?>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-navy">
              <span class="info-box-icon"><i class="fa fa-address-card"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Warga Terdaftar</span>
                <span class="info-box-number">10</span>

               
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="far fa-credit-card"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pemasukan</span>
                <span class="info-box-number">Rp 41,410</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-lightblue">
              <span class="info-box-icon"><i class="far fa-credit-card"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pengeluaran</span>
                <span class="info-box-number">Rp 41,410</span>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger">
              <span class="info-box-icon"><i class="fas fa-table"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Iuran (unverifikasi)</span>
                <span class="info-box-number">10</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      <?php } ?>
      <!-- Main row -->
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection