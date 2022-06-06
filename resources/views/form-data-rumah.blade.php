@extends('master')

@section('title-link', 'Beranda')
@section('sub-title-link', 'Tambah Data Perumahan ')
@section('title', 'Tambah Data Perumahan')

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
                            <li class="breadcrumb-item active">Tambah Data Perumahan</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        @if (Session::has('message'))
            <p hidden="true" id="message">{{ Session::get('message') }}</p>
            <p hidden="true" id="icon">{{ Session::get('icon') }}</p>
        @endif
        <!-- Main content -->

        <section class="content">
            <div class="container-fluid">
                <div class="card p-5 rounded mb-3">
                    <h5>Tambah Data Perumahan</h5>
                    <hr>
                    <form action="/add-new-iuran" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="label col-sm-2">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pemilik_rumah">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="label col-sm-2">Blok - No Rumah</label>
                            <div class="col-sm-10">
                                <select class="form-control" required="" id="toRekening" value=""
                                    name="status_tempat_tinggal">
                                    <option value="">-- Pilih Blok - No Rumah --</option>
                                    <option value="0">Rumah Kosong</option>
                                    <option value="1">Rumah Dijual</option>
                                    <option value="2">Rumah Terisi</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Status Tempat Tinggal</label>
                            <div class="col-sm-10">
                                <select class="form-control" required="" id="toRekening" value=""
                                    name="status_tempat_tinggal">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="0">Rumah Kosong</option>
                                    <option value="1">Rumah Dijual</option>
                                    <option value="2">Rumah Terisi</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="label col-sm-2">Tahun Ditempati</label>
                            <div class="col-sm-10">
                                <input type="year" class="form-control" name="tahun_ditempati" id="datepick">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <button class="btn btn-primary">Proses transaksi</button>
                                <a href="/data-iuran" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
        $("#datepick").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
    </script>
@endsection
