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
                <h1 class="masthead-heading text-uppercase mb-0">Masukan Data Baru</h1>
                <!-- Icon Divider-->
                {{-- <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div> --}}
                <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0">Konfirmasi data masuk</p>
            </div>
        </header>
        <!-- Contact Section-->
        <section class="page-section" id="hasildata">
            {{-- <h1>Data Perubahan</h1> --}}
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>NKK</th>
                                    <td class="form-control">
                                        {{ $data->nkk }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td class="form-control">
                                        {{ $data->nik }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>NAMA</th>
                                    <td class="form-control">
                                        {{ $data->nama }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>TEMPAT LAHIR</th>
                                    <td class="form-control">
                                        {{ $data->tempat_l }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>TANGGAL LAHIR</th>
                                    <td class="form-control">
                                        {{ $data->tanggal_l }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>STATUS PERNIKAHAN</th>
                                    <td class="form-control">
                                        {{ $data->status }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>JENIS KELAMIN</th>
                                    <td class="form-control">
                                        {{ $data->jenkel }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>JALAN / DUKUH</th>
                                    <td class="form-control">
                                        {{ $data->jln_dukuh }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>RT</th>
                                    <td class="form-control">
                                        {{ $data->rt }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>RW</th>
                                    <td class="form-control">
                                        {{ $data->rw }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @foreach ($data->pendukung as $p)
                            <img class="img-fluid rounded mb-5" src="{{ $p->url }} " width="200px"/>
                        @endforeach
                        <div class="col"></div>
                        <form action="{{ route('admin.terimaDataBaru', [ $data->id ]) }}" method="POST">
                            @csrf
                            <input class="btn btn-primary" type="submit" value="Terima">
                        </form>

                        <form action="{{route('admin.hapusDataBaru', [ $data->id ])}}" method="POST">
                            @csrf
                            <input class="btn btn-danger" type="submit" value="Hapus">
                        </form>
                    </div>
                </div>
            </div>
            {{-- <h3>Periksa kembali kesesuaian data dengan dokumen pendukung</h3> --}}
            
            {{-- <h5>Klik <a href='/'>disini</a> untuk kembali ke halaman awal</h5> --}}
        
            <script src="{{ asset('js/app.js') }}"></script>            
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
