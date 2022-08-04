<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" initial-scale="1.0">

    <title>Kop Surat</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <style>
        body {
            background: rgb(204, 204, 204);

            font-size: 18px;
            color: #000000;
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
        }

        page[size="A4"][layout="landscape"] {
            width: 29.7cm;
            height: 21cm;
        }

        header {
            padding-left: 70px;
            padding-top: 50px;
            padding-bottom: 0px;
        }

        img {
            width: 10%;
            position: absolute;
            z-index: 3;
        }

        government {
            font-size: 25px;
        }

        district {
            font-size: 35px;
        }

        adds {
            font-size: 14px;
        }

        intern {
            font-size: 20px;
            letter-spacing: 5px;
        }

        hr {
            border: 0;
            border-top: 5px double #000000;
            width: 80%;
        }

        .content {
            padding-left: 70px;
            padding-right: 70px;
            padding-bottom: 0;
        }

        .p-custom {
            text-align: justify;
            text-indent: 0.5in;
            line-height: 25px;
            font-size: 14px;
        }

        h3 {
            text-align: center;
            margin-top: 0;
        }

        .nomor {
            font-size: 18px;
        }

        td {
            padding-bottom: 10px;
        }

        .signature {
            padding-left: 70px;
            padding-right: 70px;
            padding-top: 5px;
        }

        .table-sign {
            /* display: inline-block; */
            text-align: center;
            font-size: 14px;
        }


        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            body,
            page {
                margin: 0;
                box-shadow: 0;
            }
        }
    </style>
</head>

<body>
    <page size="A4">
        <header>

            <center>
                <label>
                    <government>
                        Perumahan Duta Graha
                    </government>
                    <br>
                    <adds>
                        Jl. Pasir Randu, Binong, Kec. Curug, Kabupaten Tangerang, Banten 15810 </adds>
                </label>
            </center>
        </header>

        <hr>

        <div class="content">
            <h3><u>Laporan</u>
            </h3>
            <center style="margin-top: -20px;">
                <label class="nomor"></label>
            </center>
            <br>
            <br>

            {{-- <table border="0" width="100%" style="font-size: 14px">
                <tr>
                    <td>No. Surat Masuk</td>
                    <td>:</td>
                    <td>cek</td>
                </tr>
            </table> --}}
            <table border="0" width="100%" style="font-size: 10px">
                {{-- <thead> --}}
                    <tr>
                        <th>No</th>
                        <th>Tanggal Transaksi</th>
                        <th>Keterangan</th>
                        <th>Jenis Pengeluaran</th>
                        <th>Jumlah</th>
                    </tr>
                {{-- </thead> --}}
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($dataPengeluaran as $item)
                        <tr>
                            <td style="margin-left: auto">2.{{ $item->id }}</td>
                            <td>{{ $item->tanggal_pengeluaran }}</td>
                            <td>{{ $item->tujuan }}</td>
                            <td>{{ $item->tipe_pengeluaran == 0 ? 'Pengeluaran Tetap' : 'Pengeluaran Tidak Tetap' }}
                            </td>
                            <td>{{ 'Rp ' . number_format($item->nominal, 2, ',', '.') }}</td>
                        </tr>
                        @php
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
            <br><br><br><br>
            <table class="table jurnal-table" border="0" width="100%" style="font-size: 10px">
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
                    @endphp
                    @foreach ($dataPemasukan as $row)
                        @php
                            $jenisIuran = $row->keterangan;
                            $splitIuran = explode(',', $jenisIuran);
                            $month = $row->month;
                            $splitMonth = explode(',', $month);
                        @endphp
                        <tr>
                            <td>1.{{ $row->kode }}</td>
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
    </page>
</body>

</html>