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

                            @foreach ($dataWarga as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->number_identity_card }}</td>
                                    <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                                    <td>{{ $row->phone_number }}</td>
                                    <td>
                                        <button onclick="setData(this)"
                                            data-fullname='{{ $row->first_name . ' ' . $row->last_name }}'
                                            data-email='{{ $row->email }}' data-nik='{{ $row->number_identity_card }}'
                                            data-phonenumber ='{{ $row->phone_number }}' data-gender='{{ $row->gender }}'
                                            data-atasnama='{{ $row->atas_nama }}' data-norumah='{{ $row->no_rumah }}'
                                            data-blok='{{ $row->blok }}' data-tahun='{{ $row->tahun }}'
                                            data-status='{{ $row->status }}' type="button" data-target=".modal-form"
                                            data-toggle="modal"
                                            class="btn-detail btn btn-gradient-info btn-rounded btn-icon"><i
                                                class="mdi mdi-account-card-details"></i></button>

                                        <button type="button" data-target="#modal-delete" data-toggle="modal" onclick="deleteData({{$row->id}})" type="button" class="btn btn-gradient-danger btn-rounded btn-icon">
                                            <i class="mdi mdi-delete-sweep"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-md" role="document">
            <div class="modal-content rounded bg-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-modal-confirm">Detail Warga</h5>
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
    <div class="modal fade modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl" role="document">
            <div class="modal-content rounded bg-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModal">Detail Warga</h5>
                    <button type="button" class="close btn btn-gradient-primary" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <div class="row">
                        <div class="col-6">
                            <p class="font-weight-bold">Nama Lengkap</p>
                            <p class="name-user" id="full_name">
                            </p>
                            <p class="font-weight-bold">Email</p>
                            <p class="email"> </p>
                            <p class="font-weight-bold">NIK</p>
                            <p class="nik"> </p>
                            <p class="font-weight-bold">No Telepon</p>
                            <p class="no_telp"> </p>
                            <p class="font-weight-bold">Jenis Kelamin</p>
                            <p class="gender"> </p>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold">Atas Nama Rumah</p>
                            <p class="name_house"> </p>
                            <p class="font-weight-bold">No Rumah</p>
                            <p class="no_house"> </p>
                            <p class="font-weight-bold">Blok Rumah</p>
                            <p class="blok_house"> </p>
                            <p class="font-weight-bold">Status Tempat Tinggal</p>
                            <p class="status"></p>
                            <p class="font-weight-bold">Tahun Ditempati</p>
                            <p class="year"> </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
                <div class="bg-red rounded-modal" style="color: red;height:15px;"></div>
            </div>
        </div>
    </div>
    <script>
        function setData(elem) {
            $('.name-user').text($(elem).data("fullname"))
            $('.email').text($(elem).data("email"))
            $('.nik').text($(elem).data("nik"))
            $('.gender').text($(elem).data("gender"))
            $('.no_telp').text($(elem).data("phonenumber"))
            $('.name_house').text($(elem).data("atasnama"))
            $('.no_house').text($(elem).data("nohouse"))
        }

        function deleteData(id) {
            document.getElementById("btnDelete").href = `/warga/delete/${id}`;
            document.getElementById("btnDelete").innerHTML = 'Hapus';
            document.getElementById("text-description").innerHTML = 'Anda yakin ingin menghapus data tersebut?';
            document.getElementById("title-modal-confirm").innerHTML = 'Hapus Data';
        }
    </script>
@endsection
