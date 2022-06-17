
@extends('master')

@section('title-link', 'Beranda')
@section('sub-title-link', 'Data Iuran ')
@section('title', 'Data Iuran')

@section('content')
@if (Session::has('message'))
<p hidden="true" id="message">{{ Session::get('message') }}</p>
<p hidden="true" id="icon">{{ Session::get('icon') }}</p>
@endif
<!-- Main content -->

<div class="content-wrapper" style="padding: 10px 12px 0px 37px;">
    <div class="container-fluid">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Data Iuran
            </h3>
        </div>
        <div class="card p-5 rounded mb-3">
            @if (Session::get('dataUsers')->role == 0  && Session::get("dataUsers")->is_verif)
            <div class="col-sm-12 col-lg">
                <a href="/form-tambah-iuran" class="btn btn-gradient-primary btn-fw">Tambah Data</a>
            </div>
            @endif
            <div class="col-sm-12 col-lg table-responsive">
                <table id="example1" class="example1 table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID transaksi</th>
                            <th>Nama</th>
                            <th>Nominal Pembayaran</th>
                            <th>Jenis</th>
                            <th>Bulan</th>
                            <th>No Rekening</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataIuran as $row)
                        @php
                        $jenisIuran = $row->keterangan;
                        $splitIuran = explode(',', $jenisIuran);
                        $month = $row->month;
                        $splitMonth = explode(',', $month);
                        
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <?php if ($row->is_pay == 1) { ?>
                                <td>{{ $row->id_transaction }}</td>
                            <?php } else { ?>
                                <td>-</td>
                            <?php } ?>
                            <td>{{ $row->first_name." ".$row->last_name }}</td>

                            <td>@php echo number_format($row->sub_total, 2, ".", ","); @endphp</td>
                            <td>
                                iuran <?= count($splitMonth) ?> bulan
                                <hr>
                                <ul>
                                    <?php for ($i = 0; $i < count($splitIuran); $i++) { ?>
                                        <li><?= $splitIuran[$i] ?></li>
                                    <?php } ?>
                                </ul>
                            </td>
                            <td>
                                <?php for ($i = 0; $i < count($splitMonth); $i++) { ?>
                                    <?= $splitMonth[$i] ?> <br>
                                <?php } ?>
                            </td>
                            <?php if ($row->is_pay == 0) { ?>
                                <td>-</td>
                                <td>-</td>
                            <?php } else { ?>
                                <td>{{ $row->bank_name }}</td>
                                <td><a href="{{ asset('uploads/bukti') }}/{{ $row->image }}" target="_blank"><img src="{{ asset('uploads/bukti') }}/{{ $row->image }}" style="width: 50px; height:50px;" alt=""></a></td>
                            <?php } ?>

                            <td>
                                <?php if ($row->is_pay == 0) { ?>
                                    <p class="badge badge-danger">Belum Dibayar</p>
                                <?php } else { ?>
                                    <?php if ($row->is_verif == 0) {  ?>
                                        <p class="badge badge-warning">Belum Diverikasi</p>
                                    <?php } else { ?>
                                        <p class="badge badge-success">Sudah Diverikasi</p>
                                    <?php } ?>
                                <?php } ?>

                            </td>
                            <?php if ($row->is_pay == 1) { ?>
                                <td>{{ $row->date }}</td>
                            <?php } else { ?>
                                <td>-</td>
                            <?php } ?>
                            <td>
                                <?php if ($row->is_verif == 0) { ?>
                                    <!-- <a href="btn-link" style="text-decoration: none;"><button type="button"
                                            class="btn btn-gradient-success btn-rounded btn-icon" data-target="#modal-form"
                                            data-toggle="modal">
                                            <i class="mdi mdi-account-card-details"></i>
                                        </button>
                                    </a> -->
                                    @php if(Session::get('dataUsers')->role == 0){ @endphp
                                    <button type="button" data-target="#modal-form" data-toggle="modal" onclick="updateData('{{$row->id_transaction}}','{{$row->sub_total}}','{{$row->image}}','{{$row->to_rekening}}')" class="btn btn-gradient-success btn-rounded btn-icon"><i class="mdi mdi-account-card-details"></i></i></button>
                                    @php } @endphp
                                    @php if($row->is_verif == 0){ @endphp
                                    @php if(Session::get('dataUsers')->role == 1){ @endphp
                                        @php if($row->is_pay == 1){ @endphp
                                        <button type="button" data-target="#modal-check" onclick="confirmData('{{$row->id_transaction}}')" data-toggle="modal" class="btn btn-gradient-success btn-rounded btn-icon mt-1"><i class="mdi mdi-check-circle"></i></button>
                                        @php } @endphp
                                        <button type="button" data-target="#modal-detail" data-toggle="modal" onclick="checkData('{{$row->id_transaction}}','{{$row->id_users}}',`{{asset('')}}`)" class="btn btn-gradient-info btn-rounded btn-icon"><i class="mdi mdi-account-card-details"></i></button>
                                    @php }else{ @endphp

                                        <button type="button" data-target="#modal-delete" data-toggle="modal" onclick="deleteData('{{$row->id_transaction}}')" class="btn btn-gradient-danger btn-rounded btn-icon"><i class="mdi mdi-delete"></i></i></button>
                                        @php } @endphp
                                    @php } @endphp
                                <?php } ?>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog bg-white modal-xl" role="document">
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
                        <!-- <img class="ml-5" src="{{asset('uploads/profile')}}/{{Session::get('dataUsers')->photo}}" width="50%" alt=""> -->
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

<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content rounded bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Bayar Langsung</h5>
                <button type="button" class="btn btn-gradient-primary close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                 </button>
            </div>
            <div class="modal-body px-5">
                <form class="form" method="post" id="form" action="/add-rekening" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Nominal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" readonly id="nominal" required value="{{old('nominal')}}" name="nominal" placeholder="Nominal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Rekening</label>
                        <div class="col-sm-10">
                            <select class="form-control form-control-sm" id="toRekening" required value="{{old('toRekening')}}" name="toRekening">
                                <option value="">-- Pilih Rekening --</option>
                                @foreach($dataRekening as $row)
                                <option value="{{$row->id}}">{{$row->bank_name}} {{$row->number_account}} a/n {{$row->account_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Bukti Transfer</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" required name="image" id="image">
                                    <label class="custom-file-label" id="imageLabel" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                            <p id="optionalImage">(Optional) Kosongkan jika tidak ingin merubah bukti transfer</p>
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Bukti Transfer</label>
                        <div class="col-sm-9">
                            <div class="input-group col-xs-12">
                                <input type="file" required name="image" id="image" class="form-control file-upload-info" placeholder="Upload Image">
                            </div>
                            <p id="optionalImage" class="mt-2 ml-1">(Optional) Kosongkan jika tidak ingin merubah bukti transfer</p>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <button type="submit" class="btn btn-gradient-primary">Simpan</button>
                </form>
            </div>
            <div class="bg-red rounded-modal" style="color: red;height:15px;"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
        <div class="modal-content rounded bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Iuran</h5>
                <button type="button" class="btn btn-gradient-primary close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Anda yakin ingin menghapus data tersebut?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <a id="btnDelete" type="submit" class="btn btn-gradient-primary">Hapus</a>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-check" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
        <div class="modal-content rounded bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="btn btn-gradient-primary close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Anda yakin ingin mengkonfirmasi pembayaran tersebut?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <a id="btnKonfirmasi" type="submit" class="btn btn-gradient-primary">Konfirmasi</a>
                </form>
            </div>
            <div class="bg-red rounded-modal" style="color: red;height:15px;"></div>
        </div>
    </div>
</div>
<script>
    function updateData(id, nominal, image, toRekening) {
        document.getElementById("nominal").value = 'Rp ' + (parseInt(nominal)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");;
        document.getElementById("toRekening").value = toRekening;
        // document.getElementById("imageLabel").innerHTML = image;
        document.getElementById("titleModal").innerHTML = 'Perbarui Iuran';
        document.getElementById("optionalImage").hidden = false;
        document.getElementById("form").action = `/update-iuran/${id}`;
        document.getElementById("image").required = false;
    }

    function addData() {
        document.getElementById("optionalImage").hidden = true;
        document.getElementById("nominal").value = "";
        document.getElementById("toRekening").value = "";
        // document.getElementById("imageLabel").innerHTML = "";
        document.getElementById("titleModal").innerHTML = 'Tambah Iuran';
        document.getElementById("form").action = '/add-iuran';
        document.getElementById("image").required = true;
    }

    function deleteData(id) {
        document.getElementById("btnDelete").href = `/delete-iuran/${id}`;
    }

    function checkData(idTransaction, idUsers, linkImage) {
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
                    document.getElementById("profilePicture").src = linkImage + 'uploads/profile/' + data.photo;
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
                    tr.append("<td>" + (data[i].nominal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "</td>");
                    $("#tableData").append(tr);
                }
            }
        })
    }

    function confirmData(id) {
        document.getElementById("btnKonfirmasi").href = `/confirm-iuran/${id}`;
    }
</script>
@endsection