@extends('master')

@section('title-link', 'Beranda')
@section('sub-title-link', 'Profile ')
@section('title', 'Profile')

@section('content')

    <div class="content-wrapper" style="padding: 10px 12px 0px 37px;">
        @if (Session::has('message'))
            <p hidden="true" id="message">{{ Session::get('message') }}</p>
            <p hidden="true" id="icon">{{ Session::get('icon') }}</p>
        @endif

        <div class="container-fluid">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span> Profile
                </h3>
            </div>
            <div class="card p-5 rounded mb-3">
                <div class="row">
                    <div class="col-4">
                        <?php if($dataProfile->photo == null){ ?>

                        <img class="ml-5" src="{{ asset('user.png') }}" width="50%" alt="">
                        <?php }else{ ?>
                        <img class="ml-5" src="{{ asset('uploads/profile') }}/{{ Session::get('dataUsers')->photo }}"
                            width="50%" alt="">
                        <?php } ?>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-6">
                                <p class="font-weight-bold">Nama Lengkap</p>
                                <p class="name-user">{{ $dataProfile->first_name }} {{ $dataProfile->last_name }}
                                </p>
                                <p class="font-weight-bold">Email</p>
                                <p>{{ $dataProfile->email }} </p>
                                <p class="font-weight-bold">NIK</p>
                                <p>{{ $dataProfile->number_identity_card }} </p>
                                <p class="font-weight-bold">No Telepon</p>
                                <p>{{ $dataProfile->phone_number }} </p>
                                <p class="font-weight-bold">Jenis Kelamin</p>
                                <p>{{ $dataProfile->gender }} </p>
                            </div>
                            <div class="col-6">
                                <p class="font-weight-bold">Atas Nama Rumah</p>
                                <p>{{ $dataProfile->atas_nama }} </p>
                                <p class="font-weight-bold">No Rumah</p>
                                <p>{{ $dataProfile->no_rumah }} </p>
                                <p class="font-weight-bold">Blok Rumah</p>
                                <p>{{ $dataProfile->blok }} </p>
                                <p class="font-weight-bold">Status Tempat Tinggal</p>
                                @php
                                    $status = ($dataProfile->status == 0 ? 'Rumah Kosong' : $dataProfile->status == 1) ? 'Rumah Dijual' : ($dataProfile->status == 2 ? 'Rumah Terisi' : 'Rumah Dikontrakan');
                                @endphp
                                <p>{{ $status }} </p>
                                <p class="font-weight-bold">Tahun Ditempati</p>
                                <p>{{ $dataProfile->tahun }} </p>
                            </div>
                        </div>
                        <button type="button"
                            onclick="updateData(`{{ $dataProfile->id }}`,`{{ $dataProfile->email }}`,`{{ $dataProfile->first_name }}`,`{{ $dataProfile->last_name }}`,`{{ $dataProfile->number_identity_card }}`,`{{ $dataProfile->number_family_card }}`,`{{ $dataProfile->gender }}`,`{{ $dataProfile->number_of_family }}`,`{{ $dataProfile->phone_number }}`,`{{ $dataProfile->blok }}`)"
                            data-target="#modal-form" data-toggle="modal" class="btn btn-gradient-primary">Perbarui
                            Data</button>


                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <!-- /.content -->
    </div>
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-xl" role="document">
            <div class="modal-content rounded bg-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModal">Perbarui Data Diri</h5>
                    <button type="button" class="btn btn-gradient-primary close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <form class="form needs-validation" method="post" id="form" enctype="multipart/form-data"
                        action="/update-profile" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-10">
                                <input minlength="16" maxlength="16" required pattern="\d*" type="text"
                                    class="form-control needs-validation" id="numberIndentityCard"
                                    value="{{ old('number_identity_card') }}" name="numberIdentityCard" placeholder="NIK">
                                <div class="invalid-feedback">
                                    Pastikan 16 digit angka sesuai dengan identitas KTP anda.
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control needs-validation" id="firstName"
                                    value="{{ old('first_name') . ' ' . old('last_name') }}" name="namaLengkap"
                                    placeholder="Nama Lengkap">
                                <div class="invalid-feedback">
                                    Pastikan Nama Lengkap Terisi.
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" value="{{ old('email') }}"
                                    name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Blok - No Rumah</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control-sm" id="id_rumah"
                                    value="{{ old('id_rumah') }}" name="id_rumah">
                                    <option value="">-- Pilih No-Blok Rumah --</option>
                                    @foreach ($dataRumah as $item)
                                        <option value="{{ $item->rumah_id }}">{{ $item->no_rumah . ' - ' . $item->blok }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control-sm" id="gender" value="{{ old('gender') }}"
                                    name="gender">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <div class="input-group col-xs-12">
                                    <input type="file" name="image" class="form-control file-upload-info"
                                        placeholder="Upload Image">
                                </div>
                            </div>
                            <p class="mt-1">(kosongkan jika tidak ingin mengubah foto)</p>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Nomor Telepon</label>
                            <div class="col-sm-10">
                                <input minlength="10" type="text" class="form-control" id="phoneNumber"
                                    value="{{ old('phoneNumber') }}" name="phoneNumber" placeholder="Nomor Telepon">
                                <div class="invalid-feedback">
                                    Gunakan minimal 10 digit angka
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password"
                                    pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"
                                    class="form-control" id="password" value="{{ old('password') }}" name="password"
                                    placeholder="Password">
                                <div class="invalid-feedback">
                                    Gunakan minimal 8 karakter dengan campuran huruf,angka, dan simbol </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="confirmPassword"
                                    value="{{ old('confirmPassword') }}" name="confirmPassword"
                                    pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"
                                    placeholder="Konfirmasi Password">
                                <div class="invalid-feedback">
                                    Gunakan minimal 8 karakter dengan campuran huruf,angka, dan simbol </div>
                                <p class="mt-1">(kosongkan jika tidak ingin mengubah password)</p>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-gradient-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        function updateData(id, email, firstName, lastName, nik, kk, gender, numberFamily, phoneNumber, blok) {
            document.getElementById('email').value = email;
            document.getElementById('firstName').value = firstName + " " + lastName;
            document.getElementById('numberIndentityCard').value = nik;
            document.getElementById('numberFamilyCard').value = kk;
            document.getElementById('gender').value = gender;
            document.getElementById('numberOfFamily').value = numberFamily;
            document.getElementById('phoneNumber').value = phoneNumber;
            document.getElementById('blok').value = blok;
            document.getElementById("form").action = `/update-profile/${id}`;
            console.log(phoneNumber);
        }
    </script>
@endsection
