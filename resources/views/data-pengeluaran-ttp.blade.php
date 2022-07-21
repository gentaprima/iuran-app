<?php

use Illuminate\Support\Facades\Session;
?>
@extends('master')
@section('title-link', 'Beranda')
@section('sub-title-link', 'Beranda')
@section('active', 'beranda')
@section('title', 'Dashboard')

@section('content')
    @if (Session::has('message'))
        <p hidden="true" id="message">{{ Session::get('message') }}</p>
        <p hidden="true" id="icon">{{ Session::get('icon') }}</p>
    @endif
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="padding: 10px 12px 0px 37px;">
        <!-- Content Header (Page header) -->
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Data Pengeluaran
            </h3>
        </div>
        <div class="row">
            <div class="container-fluid">
                <div class="card p-5 rounded mb-3">
                    @if (Session::get('dataUsers')->role == 1)
                    <div class="col-sm-12 col-lg">
                        <button class="btn btn-gradient-primary btn-fw" data-target="#modal-form" data-toggle="modal">Buat
                            Anggaran</button>
                        </div>
                    @endif
                    <table id="example1" class="example1 table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID transaksi</th>
                                <th>Penanggung Jawab</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Nominal</th>
                                <th>Tanggal Pengeluaran</th>
                                <th>Tanggal Transaksi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($pengeluaran as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->id_transaksi }}</td>
                                    <td>{{ $item->penanggung_jawab }}</td>
                                    <td>{{ $item->tujuan }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->satuan }}</td>

                                    <td>{{ number_format($item->nominal, 2, ".", ",")}}</td>
                                    <td>{{ $item->tanggal_pengeluaran }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td><div class="badge {{$item->status == 1 ? 'badge-success' : 'badge-danger' }}">{{$item->status == 1 ? "Sudah Diterima" : "Menunggu Diterima"}}</div></td>
                                    @if (Session::get('dataUsers')->role == 2)

                                        <td><a onclick="{{ $item->status == 1 ? 'return false' : ''}}" 
                                                href="data-pengeluaran/acc/{{ $item->id_transaksi }}"> <button
                                                    class="btn {{$item->status == 1 ? 'btn-gradient-disabled' : 'btn-gradient-success '}}btn-rounded btn-icon mt-1"><i
                                                        class="mdi mdi-check-circle"></i></button></a>
                                        </td>
                                    @endif
                                </tr>
                            @php
                                $i++
                            @endphp
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-xl" role="document">
            <div class="modal-content rounded bg-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModal">Buat Anggaran Baru</h5>
                    <button type="button" class="btn btn-gradient-primary close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <form action="/data-pengeluaran" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Penanggung Jawab</label>
                                    <input name="penanggung_jawab" type="text" class="form-control"
                                        id="exampleInputUsername1" placeholder="Penanggung Jawab">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Keterangan</label>
                                    <input type="text" name="tujuan" class="form-control">
                                    <input type="hidden" name="tipe_pengeluaran" value="1" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Jumlah</label>
                                    <input name="jumlah" type="number" class="form-control" id="exampleInputUsername1"
                                        placeholder="jumlah">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Satuan</label>
                                    <select class="form-control form-control-sm" name="satuan" id="">
                                        <option value="buah">----Pilih Satuan----</option>
                                        <option value="buah">Buah</option>
                                        <option value="galon">Galon</option>
                                        <option value="pcs">Pcs</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Nominal</label>
                                    <input name="nominal" type="number" class="form-control" id="exampleInputUsername1"
                                        placeholder="Nominal">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Tanggal Pengeluaran</label>
                                    <input name="tanggal_pengeluaran" type="date" class="form-control"
                                        id="exampleInputUsername1" placeholder="Nominal">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-gradient-primary">Simpan</button>
                </div>
                </form>
                <div class="bg-red rounded-modal" style="color: red;height:15px;"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content rounded bg-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModal">Filter Data</h5>
                    <button type="button" class="btn btn-gradient-primary close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="get">
                        <div class="form-group">
                            <label for="" class="col-md-2">Pilih Bulan</label>
                            <div class="col-md-12">
                                <input type="month" name="month" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-gradient-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updateData(idTransaction, idUsers, linkImage) {
            $("#tableData tbody").empty();
            $.ajax({
                url: `/get-data-users-by-id/${idUsers}`,
                dataType: 'html',
                type: 'GET',
                success: function(response) {
                    let data = JSON.parse(response);
                    document.getElementById("fullName").innerHTML = data.first_name + ' ' + data.last_name
                    document.getElementById("email").innerHTML = data.email
                    document.getElementById("phoneNumber").innerHTML = data.phone_number
                    document.getElementById("nik").innerHTML = data.number_identity_card
                    document.getElementById("kk").innerHTML = data.number_family_card
                    document.getElementById("gender").innerHTML = data.gender
                    document.getElementById("numberOfFamily").innerHTML = data.number_of_family
                    if (data.photo == null) {
                        document.getElementById("profilePicture").src = linkImage + 'user.png';
                    } else {
                        document.getElementById("profilePicture").src = linkImage + 'uploads/profile/' + data
                            .photo;
                    }
                }
            })

            $.ajax({
                url: `/get-data-iuran-by-id/${idTransaction}`,
                dataType: 'html',
                type: 'GET',
                success: function(response) {
                    let data = JSON.parse(response);
                    let k = 1;
                    document.getElementById("buktiTransfer").src = linkImage + 'uploads/bukti/' + data[0].image;
                    for (let i = 0; i < data.length; i++) {
                        var tr = $("<tr>");
                        tr.append("<td>" + k++ + "</td>");
                        tr.append("<td>" + data[i].jenis_iuran + "</td>");
                        tr.append("<td>" + (data[i].month) + "</td>");
                        tr.append("<td>" + (data[i].nominal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") +
                            "</td>");

                        $("#tableData").append(tr);
                    }
                }
            })
        }

        function addData() {
            document.getElementById("optionalImage").hidden = true;
            document.getElementById("nominal").value = "";
            document.getElementById("toRekening").value = "";
            document.getElementById("imageLabel").innerHTML = "";
            document.getElementById("titleModal").innerHTML = 'Tambah Iuran';
            document.getElementById("form").action = '/add-iuran';
            document.getElementById("image").required = true;
        }

        function deleteData(id) {
            document.getElementById("btnDelete").href = `/delete-iuran/${id}`;
        }

        function confirmData(id) {
            document.getElementById("btnKonfirmasi").href = `/confirm-iuran/${id}`;
        }
    </script>
@endsection
