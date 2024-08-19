<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
    <link href="/css/app.css" rel="stylesheet">
</head>

<body>
    <meta id="csrf-token" content="{{ csrf_token() }}">

    @include('home')

    <form id="fm-upload" action="{{ route('admin.importData') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input id="data-upload" class="form-control" type="file" id="formFile" name="formFile" style="display: none" onchange="submitUnggahData()">
    </form>

    <form id="fm-hapus" action="{{ route('admin.hapusData') }}" method="POST">
        @csrf
    </form>


    <div class="container">
        <div class="card">
            <div class="body container">
                <div class="row p-3">
                    <div class="col-12 d-flex align-content-center">
                        <button class="btn btn-primary " onclick="unggahModalShow()">Unggah Data Pemilih (.csv)</button>
                        <div id="keterangan-upload" class="flex-grow-1"></div>
                        <a class="btn btn-secondary " href="{{route('admin.exportData')}}">Unduh Data Perubahan (.csv)</a>
                        <button class="btn btn-danger" onclick="bersihkanDataModalShow()">Bersihkan Data Pemilih</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-left" style="display: none;" id="loader">
                        <div class="preloader pl-size-xs">
                            <div class="spinner-layer pl-teal">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                        <div id="loader-text">Uploading...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="unggahModal" tabindex="-1" role="dialog" aria-labelledby="unggahModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="unggahModalLabel">Unggah Data Pemilih</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Sebelum mengunggah data pemilih pastikan:
                    <ul>
                        <li>Data yang diunggah merupakan Data yang sudah ditetapkan dalam Rapat Pleno sebelumnya.</li>
                        <li>Data yang diunggah akan ditambahkan kedalam database.</li>
                        <li>Sifat penambahan tidak menghapus data sebelumnya, sehingga pastikan tidak mengunggah data lebih dari satu kali.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="unggahModalClick()">Lanjut</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bersihModal" tabindex="-1" role="dialog" aria-labelledby="bersihModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bersihModalLabel">Hapus Data Pemilih</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Penghapusan Data Pemilih akan mengakibatkan:
                    <ul>
                        <li>Seluruh data pemilih di server akan hilang.</li>
                        <li>Seluruh pengajuan data dari masyarakat akan hilang.</li>
                    </ul>
                    sehingga pastikan data pengajuan telah diunduh sebelumnya.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="bersihModalClick()">Batal</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="bersihModalClick()">Lanjut</button>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="{{ asset('js/app.js') }}"></script>
<script>
    function submitUnggahData(){
        document.getElementById('fm-upload').submit()
    }

    function unggahModalClick(){
        document.getElementById('data-upload').click()
    }

    function unggahModalShow() {
        $('#unggahModal').modal('show')
    }

    function bersihModalClick() {
        if (confirm('Apakah yakin menghapus seluruh data?')) {
            console.log('menghap[us')
            document.getElementById('fm-hapus').submit()
        }
    }

    function bersihkanDataModalShow() {
        $('#bersihModal').modal('show')
    }
</script>

</html>
