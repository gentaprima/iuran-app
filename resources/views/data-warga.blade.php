@extends('master')

@section('title-link','Beranda')
@section('sub-title-link','Data Warga')
@section('title','Data Warga')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding: 10px 12px 0px 37px;">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Data Warga</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card p-5 rounded mb-3">
        <table id="example1" class="table table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>NIK</th>
              <th>Nama Lengkap</th>
              <th>Telepon</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>

            @foreach($dataWarga as $row)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$row->number_identity_card}}</td>
              <td>{{$row->first_name}} {{$row->last_name}}</td>
              <td>{{$row->phone_number}}</td>
              <td>
                <button type="button" data-target="#modal-form" data-toggle="modal" onclick="viewData('{{$row->id}}','{{$row->number_identity_card}}','{{$row->first_name}}','{{$row->last_name}}','{{$row->phone_number}}','{{$row->number_family_card}}','{{$row->photo}}','{{$row->number_of_family}}','{{$row->gender}}','{{$row->email}}')" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i></button>
                <button type="button" data-target="#modal-form" data-toggle="modal" onclick="updateData('{{$row->id}}','{{$row->number_identity_card}}','{{$row->first_name}}','{{$row->last_name}}','{{$row->phone_number}}','{{$row->number_family_card}}','{{$row->photo}}','{{$row->number_of_family}}','{{$row->gender}}','{{$row->email}}')" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></button>
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
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content rounded">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Tambah Rekening</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-3">

        <div class="row" id="viewData">
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
            <p id="numberFamilyCard"></p>
            <p class="font-weight-bold">Jenis Kelamin</p>
            <p id="gender"></p>
            <p class="font-weight-bold">Jumlah Anggota Keluarga</p>
            <p id="numberOfFamily"></p>
            <p class="font-weight-bold">Nomor Telepon</p>
            <p id="phoneNumber"></p>
          </div>
        </div>
        <div id="updateData">
          <form action="" id="form" method="post">
            @csrf
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" readonly id="emailForm" value="{{old('email')}}" name="email" placeholder="Email">
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Nama Depan</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="firstNameForm" value="{{old('firstName')}}" name="firstName" placeholder="Nama Depan">
                  </div>
                </div>

              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Nama Belakang</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="lastNameForm" value="{{old('lastName')}}" name="lastName" placeholder="Nama Belakang">
                  </div>
                </div>

              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">NIK</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="numberIndentityCardForm" value="{{old('numberIndentityCard')}}" name="numberIdentityCard" placeholder="NIK">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Nomor Kartu Keluarga</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="numberFamilyCardForm" value="{{old('numberFamilyCard')}}" name="numberFamilyCard" placeholder="Nomor Kartu Keluarga">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Jumlah Anggota Keluarga</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="numberOfFamilyForm" value="{{old('numberOfFamily')}}" name="numberOfFamily" placeholder="Jumlah Anggota Keluarga">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Jenis Kelamin</label>
              <div class="col-sm-10">
                <select class="form-control" id="genderForm" value="{{old('gender')}}" name="gender">
                  <option value="">-- Pilih Jenis Kelamin --</option>
                  <option value="Pria">Pria</option>
                  <option value="Wanita">Wanita</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Nomor Telepon</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="phoneNumberForm" value="{{old('phoneNumber')}}" name="phoneNumber" placeholder="Nomor Telepon">
              </div>
            </div>

        </div>
      </div>
      <div class="modal-footer" id="footerModal">
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
        <h5 class="modal-title" id="title-modal-confirm">Tambah Rekening</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 id="text-description">Anda yakin ingin menghapus data tersebut?</h5>
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
  function viewData(id, nik, firstName, lastName, phoneNumber, numberFamilyCard, photo, numberOfFamily, gender, email) {
    document.getElementById("nik").innerHTML = nik;
    document.getElementById("numberFamilyCard").innerHTML = numberFamilyCard;
    document.getElementById("phoneNumber").innerHTML = phoneNumber;
    document.getElementById("numberOfFamily").innerHTML = numberOfFamily;
    document.getElementById("gender").innerHTML = gender;
    document.getElementById("email").innerHTML = email;
    document.getElementById("fullName").innerHTML = firstName + ' ' + lastName;
    document.getElementById("titleModal").innerHTML = 'Lihat Data';
    document.getElementById("updateData").hidden = true;
    document.getElementById("viewData").hidden = false;
    document.getElementById("footerModal").hidden = true;

  }

  function updateData(id, nik, firstName, lastName, phoneNumber, numberFamilyCard, photo, numberOfFamily, gender, email) {
    document.getElementById("titleModal").innerHTML = 'Perbarui Data';
    document.getElementById("footerModal").hidden = false;
    document.getElementById("updateData").hidden = false;
    document.getElementById("viewData").hidden = true;
    document.getElementById('emailForm').value = email;
    document.getElementById('firstNameForm').value = firstName;
    document.getElementById('lastNameForm').value = lastName;
    document.getElementById('numberIndentityCardForm').value = nik;
    document.getElementById('numberFamilyCardForm').value = numberFamilyCard;
    document.getElementById('genderForm').value = gender;
    document.getElementById('numberOfFamilyForm').value = numberOfFamily;
    document.getElementById('phoneNumberForm').value = phoneNumber;
    document.getElementById("form").action = `/warga/update/${id}`;
  }


  function deleteData(id) {
    document.getElementById("btnDelete").href = `/warga/delete/${id}`;
    document.getElementById("btnDelete").innerHTML = 'Hapus';
    document.getElementById("text-description").innerHTML = 'Anda yakin ingin menghapus data tersebut?';
    document.getElementById("title-modal-confirm").innerHTML = 'Hapus Data';
  }

  function checkData(id) {
    document.getElementById("btnDelete").innerHTML = 'Konfirmasi';
    document.getElementById("title-modal-confirm").innerHTML = 'Konfirmasi Data';
    document.getElementById("btnDelete").href = `/warga/verif-data/${id}`;
    document.getElementById("text-description").innerHTML = 'Anda yakin ingin mengkonfirmasi data tersebut?';
  }
</script>
@endsection