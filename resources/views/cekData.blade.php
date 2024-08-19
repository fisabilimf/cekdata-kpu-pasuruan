{{-- <html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .warna{
            width: 15px;
            height: 5px;
            border: solid 3px black ;
            background: red;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @php
        use App\Models\KodeTms;
    @endphp
     <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-success">
        <div class="container">
          <a class="navbar-brand" href="#">Kpu Kota Pasuruan</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                  </li>
          </div>
        </div>
      </nav>
      <br><br><br>
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
            </div>
        </div>
        <div class="row">
        </div>
        @if ($data->data_tms_id !== null)
            <h5>Pemilih Tidak Memenuhi Syarat Karena</h5>
        <h5>{{ KodeTms::find($data->tms->kode)->deskripsi }}</h5>
        @else
            <div class="">
                <a href="{{ route('ubahData', [$data, $nik, $nama]) }}" class="btn btn-primary">Pengajuan Ubah
                    Data</a>
            </div>
            <br>
            <div class="">
                <a href="{{ route('tmsData', [$data, $nik, $nama]) }}" class="btn btn-primary">Pengajuan Data Tidak
                    Memenuhi Syarat</a>
            </div>
        @endif


    </div>

    <script src="{{ asset('js/app.js') }}"></script>

</body> --}}


{{-- <html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Welcome Page</title>
    <link rel="stylesheet" type="text/css" href="">
    <link href="/css/app.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .more-text {
            max-height: 5rem;
            overflow-y: hidden;
        }

        .more-text-collapsed::before {
            content: 'more...';
            background: linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
            color: #22f;
            text-align: right;
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100%;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</head>


<body>
    <div class="py-3"></div>
    <script>
        window.addEventListener('load', () => {
            for (const el of document.querySelectorAll('.more-text')) {
                if (el.scrollHeight > el.clientHeight) {
                    el.classList.add('more-text-more')
                    el.classList.add('more-text-collapsed')
                }
            }
            for (const el of document.querySelectorAll('.more-text-more')) {
                el.addEventListener('click', () => {
                    el.classList.toggle('more-text-collapsed')
                    if (!el.classList.contains('more-text-collapsed')) {
                        el.style.maxHeight = 'max-content'
                    } else {
                        el.style.maxHeight = ''
                    }
                })
            }
        })
    </script>
    <div class="py-3"></div>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>KPU Pasuruan - Cek Datamu!</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{asset('theme/assets/favicon.ico')}}" />
        <!-- Font Awesome icons (free version)-->
        <script src="{{url('https://use.fontawesome.com/releases/v5.15.3/js/all.js')}}" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('theme/css/styles.css')}}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="{{asset('img/KPU_Pasuruan.png')}}" alt="Kpu Kota Pasuruan" srcset="" width="250px"></a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="/">Home</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#hasildata">Hasil Data</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <!-- Masthead Avatar Image-->
                {{-- <img class="masthead-avatar mb-5" src="assets/img/avataaars.svg" alt="..." /> --}}
                <!-- Masthead Heading-->
                {{-- <h1 class="masthead-heading text-uppercase mb-0">Start Bootstrap</h1> --}}
                <!-- Icon Divider-->
                {{-- <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div> --}}
                <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0">Hasil pencarian ditemukan</p>
            </div>
        </header>
        <!-- Contact Section-->
        <section class="page-section" id="hasildata">
            @php
                use App\Models\KodeTms;
            @endphp

            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Data Pemilih</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-search"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Contact Section Form-->
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- NKK input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" value="{{ $data->nkk }}" data-sb-validations="required" readonly/>
                                <label for="name">Nomor Kartu Keluarga (NKK)</label>
                            </div>
                            <!-- NIK input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" value="{{ $data->nik }}" data-sb-validations="required" readonly/>
                                <label for="name">Nomor Induk Keluarga (NIK)</label>
                            </div>
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" value="{{ $data->nama }}" data-sb-validations="required" readonly/>
                                <label for="name">Nama Lengkap</label>
                            </div>
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" value="{{ $data->tempat_l }}" data-sb-validations="required" readonly/>
                                <label for="name">Tempat Lahir</label>
                            </div>
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" value="{{ $data->tanggal_l }}" data-sb-validations="required" readonly/>
                                <label for="name">Tanggal Lahir</label>
                            </div>
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" value="{{ $data->status }}" data-sb-validations="required" readonly/>
                                <label for="name">Status Pernikahan</label>
                            </div>
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" value="{{ $data->jenkel }}" data-sb-validations="required" readonly/>
                                <label for="name">Jenis Kelamin</label>
                            </div>
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" value="{{ $data->jln_dukuh }}" data-sb-validations="required" readonly/>
                                <label for="name">Jalan / Dukuh</label>
                            </div>
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" value="{{ $data->rt }}" data-sb-validations="required" readonly/>
                                <label for="name">Rukun Tetangga (RT)</label>
                            </div>
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" value="{{ $data->rw }}" data-sb-validations="required" readonly/>
                                <label for="name">Rukun Warga (RW)</label>
                            </div>
                        </form>

                        @if ($data->data_tms_id !== null)
                            <h5>Pemilih Tidak Memenuhi Syarat Karena</h5>
                        <h5>{{ KodeTms::find($data->tms->kode)->deskripsi }}</h5>
                        @else
                            <div class="">
                                <a href="{{ route('ubahData', [$data, $nik, $nama]) }}" class="btn btn-primary">Pengajuan Ubah Data</a>
                            </div>
                            <br>
                            <div class="">
                                <a href="{{ route('tmsData', [$data, $nik, $nama]) }}" class="btn btn-primary">Pengajuan Data Tidak Memenuhi Syarat</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>



        <!-- Footer-->
        <footer class="footer text-center" id="kontak">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Kerja Praktek</h4>
                        <p class="lead mb-0">
                            POLITEKNIK ELEKTRONIKA NEGERI SURABAYA
                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Temukan Kami Di</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
                    </div>
                    <!-- Footer About Text-->
                    <div class="col-lg-4">
                        <h4 class="text-uppercase mb-4">Terima Kasih</h4>
                        <p class="lead mb-0">
                            Atas segala masukan.
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; KPU Pasuruan 2021</small></div>
        </div>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('theme/js/scripts.js')}}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
