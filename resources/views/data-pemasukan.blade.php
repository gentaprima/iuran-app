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
                </span> Data Pemasukkan
            </h3>
        </div>
        <div class="row">
            <div class="container-fluid">
                <div class="card p-5 rounded mb-3">
                    <div class="col-sm-12 col-lg">
                        <button class="btn btn-gradient-primary btn-fw" data-target="#modal-filter" data-toggle="modal">Filter Data</button>
                    </div>
                    <table id="example1" class="example1 table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID transaksi</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Blok - No Rumah</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPemasukan as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->id_transaction }}</td>
                                    <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                                    <td>@php echo number_format($row->sub_total, 2, ".", ","); @endphp</td>
                                    <td>dsaokodsa</td>
                                    <?php if ($row->is_pay == 1) { ?>
                                    <td>{{ $row->date }}</td>
                                    <?php } else { ?>
                                    <td>-</td>
                                    <?php } ?>
                                    <td>
                                        <button type="button" data-target="#modal-form" data-toggle="modal"
                                            onclick="updateData('{{ $row->id_transaction }}','{{ $row->id_users }}',`{{ asset('') }}`)"
                                            class="btn btn-gradient-success btn-rounded btn-icon"><i
                                                class="mdi mdi-account-card-details"></i></button>
                                    </td>
                                </tr>
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
                    <h5 class="modal-title" id="titleModal">Detail Transaksi</h5>
                    <button type="button" class="btn btn-gradient-primary close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <img class="ml-5" id="profilePicture" width="40%" alt="">
                            <!-- <img class="ml-5" src="{{ asset('uploads/profile') }}/{{ Session::get('dataUsers')->photo }}" width="50%" alt=""> -->
                        </div>
                        <div class="col-8">
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
                                    <p class="font-weight-bold">Nomor Kartu Keluarga</p>
                                    <p id="kk"></p>
                                    <p class="font-weight-bold">Jenis Kelamin</p>
                                    <p id="gender"></p>
                                    <p class="font-weight-bold">Jumlah Anggota Keluarga</p>
                                    <p id="numberOfFamily"></p>
                                    <p class="font-weight-bold">Nomor Telepon</p>
                                    <p id="phoneNumber"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <img class="ml-5" id="buktiTransfer" width="40%" alt="">
                            <p style="margin-left:70px;margin-top:10px;" class="font-weight-bold">Bukti Transfer</p>
                        </div>
                        <div class="col-8">
                            <table id="tableData" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Iuran</th>
                                        <th>Bulan</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <!-- <button type="submit" class="btn btn-primary">Simpan</button> -->
                </div>
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
