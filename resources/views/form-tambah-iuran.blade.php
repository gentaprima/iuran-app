@extends('master')

@section('title-link', 'Beranda')
@section('sub-title-link', 'Tambah Iuran ')
@section('title', 'Tambah Iuran')

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
                    </span> Bayar Iuran
                </h3>
            </div>
            <div class="card p-5 rounded mb-3">
                <form action="/add-new-iuran" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Nama Anda</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" readonly
                                value="{{ Session::get('dataUsers')->first_name }} {{ Session::get('dataUsers')->last_name }}"
                                id="exampleInputUsername2" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Bulan Iuran</label>
                        <div class="col-sm-9">
                            <input name="month" required type="month" class="form-control form-control-sm" id="monthPick"
                                placeholder="Bulan">
                        </div>
                    </div>
                    <div class="form group row">
                        <label class="label col-sm-2">Jenis Iuran</label>
                        <div class="col-sm-10">
                            @php $total = 0; @endphp
                            @foreach ($dataJenisIuran as $row)
                                <div class="form-check form-check-flat form-check-primary">
                                    <input class="custom-control-input selectedv"
                                        onclick="checkIuran(this,'{{ $loop->iteration }}','{{ $row->nominal }}','{{ $loop->count }}')"
                                        type="radio" id="check{{ $loop->iteration }}" value="{{ $row->id }}"
                                        name="jenisIuran[]">
                                    <label for="check{{ $loop->iteration }}"
                                        class="custom-control-label">{{ $row->jenis_iuran }}</label>
                                    <input type="hidden" id="nominal-{{ $loop->iteration }}" value="0">
                                    <input type="hidden" id="countJumlahIuran" value="{{ $loop->count }}">
                                    @php $total += $row->nominal @endphp
                                </div>
                            @endforeach
                            <input type="hidden" id="sumJumlahIuran" value="{{ $total }}">
                            <div class="col-lg-5">
                                <hr>
                            </div>
                            <div style="display: none" id="monthCheck"
                                class="form-check form-check-flat form-check-primary">
                                <input class="custom-control-input" type="checkbox" onclick="checkAllIuran()" id="checkAll"
                                    name="checkManyMonths" value="1">
                                <label for="checkAll" class="custom-control-label">Ingin membayar untuk beberapa bulan
                                    kedepan?</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-3" id="formBulan" hidden="true">
                        <label class="label col-sm-2">Berapa Bulan</label>
                        <div class="col-sm-10">
                            <input type="number" min="2" name="manyMonths" value="2" onchange="setTotal(this)"
                                placeholder="Berapa bulan (minimal 2 bulan)" id="jumlahBulan" class="form-control">
                            <p style="margin: 0;" id="textbulan">Anda akan membayar iuran untuk bulan ini dan bulan depan
                            </p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Total Yang Dibayarkan</label>
                        <div class="col-sm-9">
                            <input type="text" name="total" class="form-control form-control-sm" readonly id="total">
                            <input type="hidden" name="subTotal" readonly id="totalHide" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Rekening</label>
                        <div class="col-sm-9">
                            <select class="form-control form-control-sm" required id="toRekening" required
                                value="{{ old('toRekening') }}" name="toRekening">
                                <option value="">-- Pilih Rekening --</option>
                                @foreach ($dataRekening as $row)
                                    <option value="{{ $row->id }}">{{ $row->bank_name }}
                                        {{ $row->number_account }}
                                        a/n {{ $row->account_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Bukti Transfer</label>
                        <div class="col-sm-9">
                            <div class="input-group col-xs-12">
                                <input type="file" required name="image" id="image"
                                    class="form-control file-upload-info" placeholder="Upload Image">
                            </div>
                            <!-- <p id="optionalImage">(Optional) Kosongkan jika tidak ingin merubah bukti transfer</p> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button class="btn btn-gradient-primary">Proses transaksi</button>
                            <a href="/data-iuran" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script>
        function checkIuran(val, iteration, nominal, count) {
            let total = 0;
            let checkIuran = document.getElementById(`check${iteration}`).checked;
            if (checkIuran == true) {
                document.getElementById(`nominal-${iteration}`).value = nominal;
            } else {
                document.getElementById(`nominal-${iteration}`).value = 0;
            }
            for (let i = 1; i <= count; i++) {
                let jumlahIuran = document.getElementById(`nominal-${i}`).value;
                total += parseInt(jumlahIuran)
            }
            if (iteration == 1) {
                document.getElementById('monthCheck').style.display = 'block';
                document.getElementById('total').readOnly = true;
                document.getElementById('total').value = 'Rp ' + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                document.getElementById('totalHide').value = total;
            } else {
                document.getElementById('monthCheck').style.display = 'none';
                document.getElementById('total').readOnly = false;
                document.getElementById('total').value =  0;
            }
        }

        function checkAllIuran() {
            let countJumlahIuran = document.getElementById("countJumlahIuran").value;
            let checkIuran = document.getElementById('checkAll').checked;
            if (checkIuran == true) {
                let total = document.getElementById("sumJumlahIuran").value;
                for (let i = 1; i <= countJumlahIuran; i++) {
                    // document.getElementById(`check${i}`).checked = true;
                    document.getElementById(`check${i}`).disabled = true;
                    document.getElementById('formBulan').hidden = false;
                }
                document.getElementById('total').value = 'Rp ' + (parseInt(total) * 2).toString().replace(
                    /\B(?=(\d{3})+(?!\d))/g, ".");
                document.getElementById('totalHide').value = (parseInt(total) * 2);
            } else {
                for (let i = 1; i <= countJumlahIuran; i++) {
                    document.getElementById('formBulan').hidden = true;
                    document.getElementById(`check${i}`).checked = false;
                    document.getElementById(`check${i}`).disabled = false;
                }
            }

        }

        function setTotal(val) {
            let value = val.value;
            if (value == 2) {
                document.getElementById("textbulan").innerHTML = "Anda akan membayar iuran untuk bulan ini dan bulan depan";
            } else {
                document.getElementById("textbulan").innerHTML =
                    `Anda akan membayar iuran untuk bulan ini dan ${value - 1} bulan kedepan`;

            }
            let total = document.getElementById("sumJumlahIuran").value;
            document.getElementById('total').value = 'Rp ' + (parseInt(total) * value).toString().replace(
                /\B(?=(\d{3})+(?!\d))/g, ".");
            document.getElementById('totalHide').value = parseInt(total) * value

        }
    </script>
@endsection
