@extends('master')

@section('title-link', 'Beranda')
@section('sub-title-link', 'Tambah Data Perumahan ')
@section('title', 'Tambah Data Perumahan')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="padding: 10px 12px 0px 37px;">
        <!-- Content Header (Page header) -->
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Data Blok
            </h3>
        </div>

        @if (Session::has('message'))
            <p hidden="true" id="message">{{ Session::get('message') }}</p>
            <p hidden="true" id="icon">{{ Session::get('icon') }}</p>
        @endif
        <!-- Main content -->
        <div class="row">
            <div class="container-fluid">
                <div class="card p-5 rounded mb-3">
                    <h5>{{ request()->type === 'create' ? 'Tambah' : 'Edit' }} Data Blok</h5>
                    <hr>
                    <form
                        action="{{ request()->type === 'create' ? '/data-rumah/data-blok/add' : '/data-rumah/data-blok/update/' . request()->id }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="label col-sm-2">No Rumah</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ request()->type === 'update' ? $blok->no_rumah : '' }}"
                                    class="form-control" name="no_rumah">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="label col-sm-2">Blok</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ request()->type === 'update' ? $blok->blok : '' }}"
                                    class="form-control" name="blok">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <button class="btn btn-gradient-primary">Simpan</button>
                                <a href="/data-rumah/data-blok" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

    <script>
        $("#datepick").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
    </script>
@endsection
