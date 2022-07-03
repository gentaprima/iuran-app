<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5 mb-3">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="d-flex flex-row p-2"> <img src="https://i.ibb.co/WpdmgCL/iuran-logo.png">
                    </div>
                    <hr>
                    <div class="table-responsive p-2">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold">
                                        <span>Receipt  :</span>
                                        <small>{{$data->id_transaction}}</small>
                                    </td>
                                </tr>
                                <tr class="add font-weight-bold">
                                    <td>Informasi Warga : </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">
                                        {{ strtoupper($data->first_name . ' ' . $data->last_name) }} <br>
                                        No Rumah / Blok : {{ 'Blok : '.$data->blok_name . ', No :' . $data->no_rumah }}<br>
                                        <span> Email : {{ strtoupper($data->email) }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="products p-2">
                        <table class="table table-borderless">
                            <tbody>
                                <tr class="add font-weight-bold">
                                    <td width="40%">JENIS IURAN</td>
                                    <td width="40%">BULAN</td>
                                    <td>JUMLAH</td>
                                </tr>
                                @php
                                    $splitMonth = explode(',', $data->month);
                                    $jenisIuran = $data->jenis_iuran;
                                @endphp
                                @foreach ($splitMonth as $item)
                                    <tr class="add">
                                        <td width="40%">{{ $jenisIuran }}</td>
                                        <td width="40%">{{ $item }}</td>
                                        <td>{{ 'Rp ' . number_format($data->nominal, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="products p-2">
                        <table class="table table-borderless">
                            <tbody>
                                <tr class="add font-weight-bold">
                                    <td>Total : {{ 'Rp ' . number_format($data->sub_total, 2, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="address p-2">
                        <table class="table table-borderless">
                            <tbody>
                                <tr class="add">
                                    <td>Bank Detail <br>
                                         Nama Bank : {{ $data->bank_name }} <br> Nama Tertera Direkening :
                                            {{ $data->account_name }} <br> No Rekening : {{ $data->number_account }}
                                            <br>
                                        </td>
                                    <td class="text-right">
                                        Perumahan Duta Graha <br>
                                        Jl. Pasir Randu, Binong, Kec. Curug, Kabupaten Tangerang, Banten 15810
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>
