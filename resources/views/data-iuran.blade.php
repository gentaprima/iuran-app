@extends('master')

@section('title-link','Beranda')
@section('sub-title-link','Data Iuran ')
@section('title','Data Iuran')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding: 10px 12px 0px 37px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Data Iuran</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if(Session::has('message'))
    <p hidden="true" id="message">{{ Session::get('message') }}</p>
    <p hidden="true" id="icon">{{ Session::get('icon') }}</p>
    @endif
    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="card p-5 rounded mb-3">
                <h4>Data Iuran Bulan <?= date('F') ?></h4>
                <button class="btn btn-outline-primary size-btn" onclick="addData()" data-toggle="modal" data-target="#modal-form">Tambah Data</button>
                <table id="example1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nominal Transfer</th>
                            <th>No Rekening</th>
                            <th>Bukti</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataIuran as $row)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>@php echo number_format($row->nominal, 2, ".", ","); @endphp</td>
                            <td>{{$row->bank_name}}</td>
                            <td><a href="{{asset('uploads/bukti')}}/{{$row->image}}" target="_blank"><img src="{{asset('uploads/bukti')}}/{{$row->image}}" style="width: 50px; height:50px;" alt=""></td></a>
                            <td>
                                <?php 
                                if($row->is_verif == 0){
                                ?>
                                <button class="btn btn-outline-primary">Belum Diverikasi</button>
                                <?php }else{ ?>
                                <button class="btn btn-outline-success">Sudah Diverikasi</button>
                                <?php } ?>
                            </td>
                            <td>{{$row->date}}</td>
                            <td>
                                <?php if($row->is_verif == 0){ ?>
                                <button type="button" data-target="#modal-form" data-toggle="modal" onclick="updateData('{{$row->id}}','{{$row->nominal}}','{{$row->image}}','{{$row->to_rekening}}')" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></button>
                               
                                <button type="button" data-target="#modal-delete" data-toggle="modal" onclick="deleteData('{{$row->id}}')" class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></button>
                                <?php } ?>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Tambah Rekening</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="post" id="form" action="/add-rekening" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Nominal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nominal" required value="{{old('nominal')}}" name="nominal" placeholder="Nominal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Rekening</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="toRekening" required value="{{old('toRekening')}}" name="toRekening">
                                <option value="">-- Pilih Rekening --</option>
                                @foreach($dataRekening as $row)
                                <option value="{{$row->id}}">{{$row->bank_name}} {{$row->number_account}} a/n {{$row->account_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
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
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <div class="bg-red rounded-modal" style="color: red;height:15px;"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Rekening</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Anda yakin ingin menghapus data tersebut?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <a id="btnDelete" type="submit" class="btn btn-primary">Hapus</a>
                </form>
            </div>
            <div class="bg-red rounded-modal" style="color: red;height:15px;"></div>
        </div>
    </div>
</div>
<script>
    function updateData(id, nominal, image, toRekening) {
        document.getElementById("nominal").value = nominal;
        document.getElementById("toRekening").value = toRekening;
        document.getElementById("imageLabel").innerHTML = image;
        document.getElementById("titleModal").innerHTML = 'Perbarui Iuran';
        document.getElementById("optionalImage").hidden =false;
        document.getElementById("form").action = `/update-iuran/${id}`;
        document.getElementById("image").required = false;
    }
    
    function addData() {
        document.getElementById("optionalImage").hidden =true;
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
</script>
@endsection