@extends('master')

@section('title-link','Beranda')
@section('sub-title-link','Data Jenis Iuran ')
@section('title','Data Jenis Iuran')

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
                        <li class="breadcrumb-item active">Data Jenis Iuran</li>
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
                <button class="btn btn-outline-primary size-btn" onclick="addData()" data-toggle="modal" data-target="#modal-form">Tambah Data</button>
                <table id="example1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Iuran</th>
                            <th>Nominal Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataJenis as $row)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->jenis_iuran}}</td>
                            <td>Rp @php echo number_format($row->nominal, 2, ".", ","); @endphp</td>
                            <td>
                                <button type="button" data-target="#modal-form" data-toggle="modal" onclick="updateData('{{$row->id}}','{{$row->jenis_iuran}}','{{$row->nominal}}')" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></button>
                                <button type="button" data-target="#modal-delete" data-toggle="modal" onclick="deleteData('{{$row->id}}')" class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></button>
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
                <form class="form" method="post" id="form" action="/add-rekening">
                    @csrf
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Jenis Iuran</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" required  id="jenisIuran" value="{{old('jenisIuran')}}" name="jenisIuran" placeholder="Jenis Iuran">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Nominal Pembayaran</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" required  id="nominal" value="{{old('nominal')}}" name="nominal" placeholder="Nominal Pembayaran">
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
                <h5 class="modal-title" id="exampleModalLabel">Hapus Jenis Iuran</h5>
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
    function updateData(id,jenisIuran,nominal){
        document.getElementById("jenisIuran").value = jenisIuran;
        document.getElementById("nominal").value = nominal;
        document.getElementById("titleModal").innerHTML = 'Perbarui Jenis Iuran';
        document.getElementById("form").action = `/update-jenis-iuran/${id}`;
    }
    
    function addData(){
        document.getElementById("jenisIuran").value = "";
        document.getElementById("nominal").value = "";
        document.getElementById("titleModal").innerHTML = 'Tambah Jenis Iuran';
        document.getElementById("form").action = '/add-jenis-iuran';
    }

    function deleteData(id){
        document.getElementById("btnDelete").href = `/delete-jenis-iuran/${id}`;
    }
</script>
@endsection