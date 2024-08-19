<html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
    <link href="/css/app.css" rel="stylesheet">
</head>

<body>
@php
    use App\Models\KodeTms;
@endphp

    <h1>Data TMS</h1>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Pengajuan Data TMS</h3>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>NKK</th>
                            <td>
                                {{ $data->data_pemilih->nkk }}
                            </td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>
                                {{ $data->data_pemilih->nik }}
                            </td>
                        </tr>
                        <tr>
                            <th>NAMA</th>
                            <td>
                                {{ $data->data_pemilih->nama }}
                            </td>
                        </tr>
                        <tr>
                            <th>TEMPAT LAHIR</th>
                            <td>
                                {{ $data->data_pemilih->tempat_l }}
                            </td>
                        </tr>
                        <tr>
                            <th>TANGGAL LAHIR</th>
                            <td>
                                {{ $data->data_pemilih->tanggal_l }}
                            </td>
                        </tr>
                        <tr>
                            <th>STATUS PERNIKAHAN</th>
                            <td>
                                {{ $data->data_pemilih->status }}
                            </td>
                        </tr>
                        <tr>
                            <th>JENIS KELAMIN</th>
                            <td>
                                {{ $data->data_pemilih->jenkel }}
                            </td>
                        </tr>
                        <tr>
                            <th>JALAN / DUKUH</th>
                            <td>
                                {{ $data->data_pemilih->jln_dukuh }}
                            </td>
                        </tr>
                        <tr>
                            <th>RT</th>
                            <td>
                                {{ $data->data_pemilih->rt }}
                            </td>
                        </tr>
                        <tr>
                            <th>RW</th>
                            <td>
                                {{ $data->data_pemilih->rw }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <h3>Sebab TMS : {{ KodeTms::find($data->kode)->deskripsi }}</h3>
            </div>
            <div class="row">
                @foreach ($data->pendukung as $p)
                    <img src="{{ $p->url }} " />
                @endforeach
            </div>
        </div>
    </div>
    <h3>Periksa kembali kesesuaian data dengan dokumen pendukung</h3>
    <form action="{{ route('admin.terimaDataTms', [$data->id]) }}" method="POST">
        @csrf
        <input type="submit" value="Terima">
    </form>
    <form action="{{ route('admin.hapusDataTms', [$data->id]) }}" method="POST">
        @csrf
        <input type="submit" value="Hapus">
    </form>
    <h5>Klik <a href='/'>disini</a> untuk kembali ke halaman awal</h5>

    <script src="{{ asset('js/app.js') }}"></script>

</body>
