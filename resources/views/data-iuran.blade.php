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
                @if (Session::get('dataUsers')->role == 0 )
                    <div class="col-sm-12 col-lg">
                        <a href="/form-tambah-iuran" class="btn btn-primary btn-fw">Tambah Data</a>
                    </div>
                @endif
                <table id="example1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID transaksi</th>
                            <th>Nominal Pembayaran</th>
                            <th>Jenis</th>
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
                                $jenisIuran = $row->jenis_iuran;
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
                                <td>@php echo number_format($row->sub_total, 2, ".", ","); @endphp</td>
                                <td>
                                    <ul>
                                        <?php for($i = 0;$i <count($splitIuran);$i++){ ?>
                                        <li><?= $splitIuran[$i] ?> (<?= $splitMonth[$i] ?>)</li>
                                        <?php } ?>
                                    </ul>
                                </td>
                                <?php if ($row->is_pay == 0) { ?>
                                <td>-</td>
                                <td>-</td>
                                <?php } else { ?>
                                <td>{{ $row->bank_name }}</td>
                                <td><a href="{{ asset('uploads/bukti') }}/{{ $row->image }}" target="_blank"><img
                                            src="{{ asset('uploads/bukti') }}/{{ $row->image }}"
                                            style="width: 50px; height:50px;" alt=""></a></td>
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
                                    <a href="btn-link" style="text-decoration: none;"><button type="button"
                                            class="btn btn-gradient-success btn-rounded btn-icon" data-target="#modal-form"
                                            data-toggle="modal">
                                            <i class="mdi mdi-account-card-details"></i>
                                        </button>
                                    </a>
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
@endsection
