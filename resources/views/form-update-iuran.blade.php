@extends('master')

@section('title-link','Beranda')
@section('sub-title-link','Perbarui Iuran ')
@section('title','Perbarui Iuran')

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
                        <li class="breadcrumb-item active">Perbarui Iuran</li>
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
                <h5>Tambah Iuran</h5>
                <hr>
                <form action="/add-new-iuran" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group row">
                        <label class="label col-sm-2">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" readonly value="{{Session::get('dataUsers')->first_name }} {{Session::get('dataUsers')->last_name }}" class="form-control">
                        </div>
                    </div>
                    <div class="form group row">
                        <label class="label col-sm-2">Jenis Iuran</label>
                        <div class="col-sm-10">
                            @php $total = 0; @endphp
                            @foreach($dataJenisIuran as $row)
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" onclick="checkIuran(this,'{{$loop->iteration}}','{{$row->nominal}}','{{$loop->count}}')" type="checkbox" id="check{{$loop->iteration}}" value="{{$row->id}}" name="jenisIuran[]">
                                <label for="check{{$loop->iteration}}" class="custom-control-label">{{$row->jenis_iuran}}</label>
                                <input type="hidden" id="nominal-{{$loop->iteration}}" value="0">
                                <input type="hidden" id="countJumlahIuran" value="{{$loop->count}}">
                                @php $total += $row->nominal @endphp
                            </div>
                            @endforeach
                            <input type="hidden" id="sumJumlahIuran" value="{{$total}}">
                            <hr>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" onclick="checkAllIuran()" id="checkAll" name="checkManyMonths" value="1">
                                <label for="checkAll" class="custom-control-label">Ingir membayar untuk beberapa bulan kedepan?</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-3" id="formBulan" hidden="true">
                        <label class="label col-sm-2">Berapa Bulan</label>
                        <div class="col-sm-10">
                            <input type="number" min="2" name="manyMonths" value="2" onchange="setTotal(this)" placeholder="Berapa bulan (minimal 2 bulan)" id="jumlahBulan" class="form-control">
                            <p style="margin: 0;" id="textbulan">Anda akan membayar iuran untuk bulan ini dan bulan depan</p>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="label col-sm-2">Total Pembayaran</label>
                        <div class="col-sm-10">
                            <input type="text" readonly id="total" class="form-control">
                            <input type="hidden" name="subTotal" readonly id="totalHide" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Rekening</label>
                        <div class="col-sm-10">
                            <select class="form-control" required id="toRekening" required value="{{old('toRekening')}}" name="toRekening">
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
                                    <input type="file" required class="custom-file-input" required name="image" id="image">
                                    <label class="custom-file-label" id="imageLabel" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                            <!-- <p id="optionalImage">(Optional) Kosongkan jika tidak ingin merubah bukti transfer</p> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button class="btn btn-primary">Proses transaksi</button>
                            <button class="btn btn-secondary">Kembali</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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

        document.getElementById('total').value = 'Rp ' + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        document.getElementById('totalHide').value = total;


    }

    function checkAllIuran() {
        let countJumlahIuran = document.getElementById("countJumlahIuran").value;
        let checkIuran = document.getElementById('checkAll').checked;
        if (checkIuran == true) {
            let total = document.getElementById("sumJumlahIuran").value;
            for (let i = 1; i <= countJumlahIuran; i++) {
                document.getElementById(`check${i}`).checked = true;
                document.getElementById(`check${i}`).disabled = true;
                document.getElementById('formBulan').hidden = false;
            }
            document.getElementById('total').value = 'Rp ' + (parseInt(total) * 2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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
            document.getElementById("textbulan").innerHTML = `Anda akan membayar iuran untuk bulan ini dan ${value - 1} bulan kedepan`;

        }
        let total = document.getElementById("sumJumlahIuran").value;
        document.getElementById('total').value = 'Rp ' + (parseInt(total) * value).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        document.getElementById('totalHide').value = parseInt(total) * value

    }
</script>
@endsection