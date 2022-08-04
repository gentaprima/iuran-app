<?php

use Illuminate\Support\Facades\Session;
?>
@extends('master')

@section('title-link', 'Laporan Keuangan')
@section('sub-title-link', 'Laporan Keuangan')
@section('active', 'beranda')
@section('title', 'Laporan Keuangan')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="padding: 10px 12px 0px 37px;">
        <!-- Content Header (Page header) -->
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Laporan Keuangan
            </h3>
        </div>
        <div class="row">
            <div class="container-fluid">
                <div class="card p-5 rounded mb-3" id="content-pdf">
                    <div class="row justify-content-between">
                        <div class="col-sm-1 col-lg-3">
                            <a href="/print?date={{ Request::get('date') }}" id="pdf"
                                class="btn btn-gradient-primary"><i class="mdi mdi-file-pdf">PDF</i></a>
                        </div>
                        <form action="" method="get">
                            <div class="row justify-content-end align-items-center">
                                <div class="col-sm-2 col-lg-2">
                                    <input type="month" id="date" name="date" class="form-control">
                                </div>
                                <div class="col-sm-2 col-lg-2">
                                    <button class="btn btn-gradient-primary">Filter</button>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <h5 class="text-center pt-2 pb-2">Pengeluaran</h5>
                            <hr>
                            @php
                                $totalPemasukkan = 0;
                                $i = 1;
                            @endphp
                            <div class="table-responsive">
                                <table class="table jurnal-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Keterangan</th>
                                            <th>Jenis Pengeluaran</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($dataPengeluaran as $item)
                                            <tr>
                                                <td>{{ $i }}.</td>
                                                <td>{{ $item->tanggal_pengeluaran }}</td>
                                                <td>{{ $item->tujuan }}</td>
                                                <td>{{ $item->tipe_pengeluaran == 0 ? 'Pengeluaran Tetap' : 'Pengeluaran Tidak Tetap' }}
                                                </td>
                                                <td>{{ 'Rp ' . number_format($item->nominal, 2, ',', '.') }}</td>
                                            </tr>
                                            @php
                                                $i++;
                                                $total = $total + $item->nominal;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total Pengeluaran</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>{{ 'Rp ' . number_format($total, 2, ',', '.') }}</th>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <h5 class="text-center pt-2 pb-2">Pemasukan</h5>
                            <hr>
                            <table class="table jurnal-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalPemasukkan = 0;
                                        $j = 1;
                                    @endphp
                                    @foreach ($dataPemasukan as $row)
                                        @php
                                            $jenisIuran = $row->keterangan;
                                            $splitIuran = explode(',', $jenisIuran);
                                            $month = $row->month;
                                            $splitMonth = explode(',', $month);
                                        @endphp
                                        <tr>
                                            <td>{{ $j }}.</td>
                                            <td>{{ $row->date }}</td>
                                            <td>
                                                <?php for ($i = 0; $i < count($splitMonth); $i++) { ?>
                                                <?php if($splitMonth[count($splitMonth) - 1] == $i){ ?>
                                                <span class="font-weight-bold"> <?= $splitMonth[$i] ?>, </span>
                                                <?php }else{?>
                                                <span class="font-weight-bold"> <?= $splitMonth[$i] ?></span>
                                                <?php }?>
                                                <?php } ?>
                                                <hr>
                                                <ul>
                                                    @if (count($splitIuran) > 0)
                                                        <?php for ($i = 0; $i < count($splitIuran); $i++) { ?>
                                                        <li><?= $splitIuran[$i] ?></li>
                                                        <?php } ?>
                                                    @endif
                                                </ul>
                                            </td>

                                            <td>{{ 'Rp ' . number_format($row->sub_total, 2, ',', '.') }}</td>
                                        </tr>
                                        @php
                                            $j++;
                                            $totalPemasukkan += $row->sub_total;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total Saldo</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{ 'Rp ' . number_format($totalPemasukkan, 2, ',', '.') }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Sisa Saldo</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{ $totalMasuk > 0 ? 'Rp ' . number_format($totalPemasukkan - $total, 2, ',', '.') : 'Rp ' . number_format(0, 2, ',', '.') }}
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    </div>
@endsection
