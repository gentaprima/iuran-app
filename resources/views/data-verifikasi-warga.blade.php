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
      </span> Verifikasi Warga
    </h3>
  </div>
  <div class="row">
    <div class="container-fluid">
      <div class="card p-5 rounded mb-3">
        <table id="example1" class="example1 table table-striped">
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

            @foreach($dataVerifikasi as $row)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$row->number_identity_card}}</td>
              <td>{{$row->first_name}} {{$row->last_name}}</td>
              <td>{{$row->phone_number}}</td>
              <td>
                <button type="button" data-target="#modal-delete" data-toggle="modal" onclick="checkData('{{$row->id}}')" class="btn btn-gradient-success btn-rounded btn-icon"><i class="mdi mdi-check-circle"></i></button>
                <button type="button" data-target="#modal-form" data-toggle="modal" onclick="viewData('{{$row->id}}','{{$row->number_identity_card}}','{{$row->first_name}}','{{$row->last_name}}','{{$row->phone_number}}','{{$row->photo}}','{{$row->gender}}','{{$row->email}}','{{$row->blok}}','{{$row->no_rumah}}')" class="btn btn-gradient-info btn-rounded btn-icon"><i class="mdi mdi-account-card-details"></i></button>
                <button type="button" data-target="#modal-delete" data-toggle="modal" onclick="deleteData('{{$row->id}}')" class="btn btn-gradient-danger btn-rounded btn-icon"><i class="mdi mdi-delete-sweep"></i></button>
              </td>
            </tr>
            @endforeach

          </tbody>

        </table>
      </div>
    </div><!-- /.container-fluid -->
  </div>
  <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl" role="document">
      <div class="modal-content rounded bg-white">
        <div class="modal-header">
          <h5 class="modal-title" id="titleModal">Tambah Rekening</h5>
          <button type="button" class="close btn btn-gradient-primary" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body px-5">

          <div class="row">
            <div class="col-6">
              <p class="font-weight-bold">Nama Lengkap</p>
              <p class="name-user" id="fullName"></p>
              <p class="font-weight-bold">Email</p>
              <p id="email"></p>
              <p class="font-weight-bold">NIK</p>
              <p id="nik"></p>
            </div>
            <div class="col-6">
              <p class="font-weight-bold">Jenis Kelamin</p>
              <p id="gender"></p>
              <p class="font-weight-bold">Nomor Telepon</p>
              <p id="phoneNumber"></p>
              <p class="font-weight-bold">Blok Rumah</p>
              <p id="blok"></p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
        </div>
        <div class="bg-red rounded-modal" style="color: red;height:15px;"></div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
      <div class="modal-content rounded bg-white">
        <div class="modal-header">
          <h5 class="modal-title" id="title-modal-confirm">Tambah Rekening</h5>
        <a href="">
          <button type="button" class="close btn-gradient-primary" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </a>
        </div>
        <div class="modal-body">
          <h5 id="text-description">Anda yakin ingin menghapus data tersebut?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
            <a id="btnDelete" class="btn btn-gradient-primary" href="">Hapus</a>
        </div>
      </div>
    </div>
  </div>
  <script>
    function viewData(id, nik, firstName, lastName, phoneNumber, photo, gender, email, blok,noRumah) {
      document.getElementById("nik").innerHTML = nik;
      document.getElementById("phoneNumber").innerHTML = phoneNumber;
      document.getElementById("gender").innerHTML = gender;
      document.getElementById("email").innerHTML = email;
      document.getElementById("blok").innerHTML = blok+'-'+noRumah;
      document.getElementById("fullName").innerHTML = firstName + ' ' + lastName;
      document.getElementById("titleModal").innerHTML = 'Lihat Data';
    }

    function deleteData(id) {
      document.getElementById("btnDelete").href = `/warga/delete/${id}`;
      document.getElementById("btnDelete").innerHTML = 'Hapus';
      document.getElementById("text-description").innerHTML = 'Anda yakin ingin menghapus data tersebut?';
      document.getElementById("title-modal-confirm").innerHTML = 'Hapus Data';
    }

    function checkData(id) {
      document.getElementById("btnDelete").innerHTML = 'Konfirmasi';
      document.getElementById("title-modal-confirm").innerHTML = 'Konfirmasi Data';
      document.getElementById("btnDelete").href = `/warga/verif-data/${id}`;
      document.getElementById("text-description").innerHTML = 'Anda yakin ingin mengkonfirmasi data tersebut?';
    }
  </script>
  @endsection