<html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
    <link href="/css/app.css" rel="stylesheet">
</head>

<body>
    @php
        $dpemilih = \App\Models\DataPemilih::find($data->data_pemilih_id);
    @endphp
    <h1>Data Tidak Memenuhi Syarat</h1>
    <h2>
        {{
        array(
        'Meninggal dunia',
        'Ditemukan data ganda',
        'Dibawah Umur',
        'Pindah Domisili',
        'Tidak Dikenal',
        'TNI',
        'Polri',
        'Hilang ingatan',
        'Hak Pilih di Cabut',
        'Bukan Penduduk'
        )[$data->kode-1]
    }}
    </h2>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>NKK</th>
                            <td>
                                {{ $dpemilih->nkk }}
                            </td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>
                                {{ $dpemilih->nik }}
                            </td>
                        </tr>
                        <tr>
                            <th>NAMA</th>
                            <td>
                                {{ $dpemilih->nama }}
                            </td>
                        </tr>
                        <tr>
                            <th>TEMPAT LAHIR</th>
                            <td>
                                {{ $dpemilih->tempat_l }}
                            </td>
                        </tr>
                        <tr>
                            <th>TANGGAL LAHIR</th>
                            <td>
                                {{ $dpemilih->tanggal_l }}
                            </td>
                        </tr>
                        <tr>
                            <th>STATUS PERNIKAHAN</th>
                            <td>
                                {{ $dpemilih->status }}
                            </td>
                        </tr>
                        <tr>
                            <th>JENIS KELAMIN</th>
                            <td>
                                {{ $dpemilih->jenkel }}
                            </td>
                        </tr>
                        <tr>
                            <th>JALAN / DUKUH</th>
                            <td>
                                {{ $dpemilih->jln_dukuh }}
                            </td>
                        </tr>
                        <tr>
                            <th>RT</th>
                            <td>
                                {{ $dpemilih->rt }}
                            </td>
                        </tr>
                        <tr>
                            <th>RW</th>
                            <td>
                                {{ $dpemilih->rw }}
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
