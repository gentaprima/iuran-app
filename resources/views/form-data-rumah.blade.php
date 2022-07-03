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
                </span> Data Rumah
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
                    <h5>{{ request()->type === 'create' ? 'Tambah' : 'Edit' }} Data Perumahan</h5>
                    <hr>
                    <form class="forms-sample"
                        action="{{ request()->type === 'create' ? '/data-rumah/store' : '/data-rumah/update/' . request()->id }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="label col-sm-2">Nama Pemilik</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ request()->type === 'update' ? $house->atas_nama : '' }}"
                                    class="form-control form-control-sm" name="atas_nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Pilih Blok - No Rumah</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control-sm" required="" value="" name="blok">
                                    <option value="">-- Pilih Blok - Rumah --</option>
                                    @foreach ($blok as $row)
                                        <option value="{{ $row->id }}"
                                            {{ request()->type == 'update' && $house->f_blok === $row->id ? 'selected' : '' }}>
                                            {{ $row->blok . ' - ' . $row->no_rumah }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Status Tempat Tinggal</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control-sm" required="" value="" name="status">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="0"
                                        {{ request()->type == 'update' && $house->status == 0 ? 'selected' : '' }}>Rumah
                                        Kosong</option>
                                    <option value="1"
                                        {{ request()->type == 'update' && $house->status == 1 ? 'selected' : '' }}>Rumah
                                        Dijual</option>
                                    <option value="2"
                                        {{ request()->type == 'update' && $house->status == 2 ? 'selected' : '' }}>Rumah
                                        Terisi</option>
                                    <option value="3"
                                        {{ request()->type == 'update' && $house->status == 2 ? 'selected' : '' }}>Rumah
                                        Dikontrakan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="label col-sm-2">Tahun Ditempati</label>
                            <div class="col-sm-10">
                                <input type="number" value="{{request()->type == 'update' ? $house->tahun : ''}}" class="form-control form-control-sm" name="tahun" id="datepick">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <button class="btn btn-gradient-primary">Simpan</button>
                                <a href="/data-rumah" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
