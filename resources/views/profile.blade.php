@extends('master')

@section('title-link','Beranda')
@section('sub-title-link','Profile ')
@section('title','Profile')

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
                        <li class="breadcrumb-item active">Profile</li>
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
                <div class="row">
                    <div class="col-4">
                        <?php if($dataProfile->photo == null){ ?>

                            <img class="ml-5" src="{{asset('user.png')}}" width="50%" alt="">
                        <?php }else{ ?>
                            <img class="ml-5" src="{{asset('uploads/profile')}}/{{Session::get('dataUsers')->photo}}" width="50%" alt="">
                        <?php } ?>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-6">
                                <p class="font-weight-bold">Nama Lengkap</p>
                                <p class="name-user">{{$dataProfile->first_name}} {{$dataProfile->last_name}}</p>
                                <p class="font-weight-bold">Email</p>
                                <p>{{$dataProfile->email}} </p>
                                <p class="font-weight-bold">NIK</p>
                                <p>{{$dataProfile->number_identity_card}} </p>
                            </div>
                            <div class="col-6">
                                <p class="font-weight-bold">Nomor Kartu Keluarga</p>
                                <p>{{$dataProfile->number_family_card}} </p>
                                <p class="font-weight-bold">Jenis Kelamin</p>
                                <p>{{$dataProfile->gender}} </p>
                                <p class="font-weight-bold">Jumlah Anggota Keluarga</p>
                                <p>{{$dataProfile->number_of_family}} </p>
                                <p class="font-weight-bold">Nomor Telepon</p>
                                <p>{{$dataProfile->phone_number}} </p>
                            </div>
                        </div>
                        <button type="button" onclick="updateData(`{{$dataProfile->id}}`,`{{$dataProfile->email}}`,`{{$dataProfile->first_name}}`,`{{$dataProfile->last_name}}`,`{{$dataProfile->number_identity_card}}`,`{{$dataProfile->number_family_card}}`,`{{$dataProfile->gender}}`,`{{$dataProfile->number_of_family}}`,`{{$dataProfile->phone_number}}`)" data-target="#modal-form" data-toggle="modal" class="btn btn-outline-primary">Perbarui Data</button>


                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl" role="document">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Perbarui Data Diri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="post" id="form" action="/update-profile" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Nama Depan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="firstName" value="{{old('firstName')}}" name="firstName" placeholder="Nama Depan">
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Nama Belakang</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="lastName" value="{{old('lastName')}}" name="lastName" placeholder="Nama Belakang">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" value="{{old('email')}}" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="numberIndentityCard" value="{{old('numberIndentityCard')}}" name="numberIdentityCard" placeholder="NIK">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Nomor Kartu Keluarga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="numberFamilyCard" value="{{old('numberFamilyCard')}}" name="numberFamilyCard" placeholder="Nomor Kartu Keluarga">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Jumlah Anggota Keluarga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="numberOfFamily" value="{{old('numberOfFamily')}}" name="numberOfFamily" placeholder="Jumlah Anggota Keluarga">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="gender" value="{{old('gender')}}" name="gender">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                            <p class="mt-1">(kosongkan jika tidak ingin mengubah foto)</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Nomor Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phoneNumber" value="{{old('phoneNumber')}}" name="phoneNumber" placeholder="Nomor Telepon">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" value="{{old('password')}}" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="confirmPassword" value="{{old('confirmPassword')}}" name="confirmPassword" placeholder="Konfirmasi Password">
                            <p class="mt-1">(kosongkan jika tidak ingin mengubah password)</p>
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

<script>
    function updateData(id,email,firstName,lastName,nik,kk,gender,numberFamily,phoneNumber){
        document.getElementById('email').value = email;
        document.getElementById('firstName').value = firstName;
        document.getElementById('lastName').value = lastName;
        document.getElementById('numberIndentityCard').value = nik;
        document.getElementById('numberFamilyCard').value = kk;
        document.getElementById('gender').value = gender;
        document.getElementById('numberOfFamily').value = numberFamily;
        document.getElementById('phoneNumber').value = phoneNumber;
        document.getElementById("form").action = `/update-profile/${id}`;
    }
</script>
@endsection