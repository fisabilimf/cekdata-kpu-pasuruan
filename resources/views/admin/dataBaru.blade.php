<html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
    <link href="/css/app.css" rel="stylesheet">
</head>

<body>
    <meta id="csrf-token" content="{{ csrf_token() }}">

    @include('home')
    @csrf

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Permintaan Data Baru</h1>
            </div>
        </div>
        <div class="row">
            <div id="dataBaruTable" class="col-12" data-url="{{ route('apiBaru') }}" style="display: grid">
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/dyntable.js') }}"></script>

<script>
    function editRow(ev, el) {
        window.location.href = '/admin/periksaDataBaru/' + el.getAttribute('data-id')
    }
    window.addEventListener('load', () => {
        const options = {
            tableElement: 'dataBaruTable',
            columns: {
                'nkk': {
                    label: 'NKK',
                    width: '5fr',
                    cssClass: 'justify-content-end px-4',
                    position: 1
                },
                'nik': {
                    label: 'NIK',
                    width: '5fr',
                    cssClass: 'justify-content-end px-4',
                    position: 2
                },
                'nama': {
                    label: 'NAMA',
                    width: '7fr',
                    cssClass: 'justify-content-end px-4',
                    position: 3
                },
                'tempat_l': {
                    label: 'TMPT L',
                    width: '5fr',
                    cssClass: 'justify-content-end px-4',
                    position: 4
                },
                'tanggal_l': {
                    label: 'TGL L',
                    width: '5fr',
                    cssClass: 'justify-content-end px-4',
                    position: 5
                },
                'status': {
                    label: 'S',
                    width: '1fr',
                    cssClass: 'justify-content-end px-4',
                    position: 6
                },
                'jenkel': {
                    label: 'J',
                    width: '1fr',
                    cssClass: 'justify-content-end px-4',
                    position: 7
                },
                'jln_dukuh': {
                    label: 'JLN/DUKUH',
                    width: '5fr',
                    cssClass: 'justify-content-end px-4',
                    position: 8
                },
                'rt': {
                    label: 'RW',
                    width: '2fr',
                    cssClass: 'justify-content-end px-4',
                    position: 9
                },
                'rw': {
                    label: 'RT',
                    width: '2fr',
                    cssClass: 'justify-content-end px-4',
                    position: 10
                },
                'disabilitas': {
                    label: 'D',
                    width: '1fr',
                    cssClass: 'justify-content-end px-4',
                    position: 11
                },
            },
            // expandRow: true,
            reqHeader: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": document.getElementById('csrf-token').getAttribute('content')
            },
            colFormatter: {

            },
            gridAutoRows: '4em',
            clickRowCallback: editRow,
        }
        console.log('initdyn')
        initDynTable(options)

    })
</script>

</html>
