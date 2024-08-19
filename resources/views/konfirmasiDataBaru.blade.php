<html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
    <link href="/css/app.css" rel="stylesheet">
</head>

<body>
    <h1>Data Perubahan</h1>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>NKK</th>
                            <td>
                                {{ $data->nkk }}
                            </td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>
                                {{ $data->nik }}
                            </td>
                        </tr>
                        <tr>
                            <th>NAMA</th>
                            <td>
                                {{ $data->nama }}
                            </td>
                        </tr>
                        <tr>
                            <th>TEMPAT LAHIR</th>
                            <td>
                                {{ $data->tempat_l }}
                            </td>
                        </tr>
                        <tr>
                            <th>TANGGAL LAHIR</th>
                            <td>
                                {{ $data->tanggal_l }}
                            </td>
                        </tr>
                        <tr>
                            <th>STATUS PERNIKAHAN</th>
                            <td>
                                {{ $data->status }}
                            </td>
                        </tr>
                        <tr>
                            <th>JENIS KELAMIN</th>
                            <td>
                                {{ $data->jenkel }}
                            </td>
                        </tr>
                        <tr>
                            <th>JALAN / DUKUH</th>
                            <td>
                                {{ $data->jln_dukuh }}
                            </td>
                        </tr>
                        <tr>
                            <th>RT</th>
                            <td>
                                {{ $data->rt }}
                            </td>
                        </tr>
                        <tr>
                            <th>RW</th>
                            <td>
                                {{ $data->rw }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                @foreach ($pendukung as $p)
                    <img src="{{ $p->url }} " />
                @endforeach
            </div>
        </div>
    </div>
    <h3>Data akan di periksa ulang oleh KPU sebelum dapat diterima dalam Data Pemilih</h3>
    <h5>Klik <a href='/'>disini</a> untuk kembali ke halaman awal</h5>

    <script src="{{ asset('js/app.js') }}"></script>

</body>
