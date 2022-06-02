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
        <?php if($dataIuran == null){ ?>
          <!-- <div class="row">
            <div class="col-md-12">
              <div class="alert alert-success">
                <div class="row">
  
                  <div class="col-md-6 mt-2" >
                  Silahkan klik tombol untuk tagih iuran bulan ini kepada warga 
                </div>
                <div class="col-md-6">
                  
                  <button type="button" data-toggle="modal" data-target="#modal-form" style="float: right;" class="btn btn-outline-white">Tagih Iuran</button>
                </div>
              </div>
              </div>
            </div>
          </div> -->
        <?php } ?>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-navy">
              <span class="info-box-icon"><i class="fa fa-address-card"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Warga Terdaftar</span>
                <span class="info-box-number"><?= count($dataWarga); ?></span>

               
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
                <span class="info-box-number">Rp @php echo number_format($dataPemasukan, 2, ".", ","); @endphp</span>
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
                <span class="info-box-number"><?= count($dataIuranUnVerif) ?></span>
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
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content rounded">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tagih Iuran</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <h5>Anda yakin ingin memulai tagihan untuk bulan ini?</h5>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
              <a href="/tagih-iuran" type="submit" class="btn btn-primary">Proses</a>
              </form>
          </div>
          <div class="bg-red rounded-modal" style="color: red;height:15px;"></div>
      </div>
  </div>
</div>
@endsection