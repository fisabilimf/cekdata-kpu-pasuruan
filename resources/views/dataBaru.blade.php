@php
    use App\Models\KodeTms;

@endphp

{{-- <html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
    <h1>PENGAJUAN DATA BARU</h1>


</body> --}}

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
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#inputdata">Input Data</a></li>
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
                <h1 class="masthead-heading text-uppercase mb-0">Pendaftaran Data Baru</h1>
                <!-- Icon Divider-->
                {{-- <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div> --}}
                <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0">Silakan diisi sesuai dengan yang dibutuhkan</p>
            </div>
        </header>
        <!-- Contact Section-->
        <section class="page-section" id="inputdata">
            <div class="container">
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    {{ $error }} <br/>
                    @endforeach
                </div>
                @endif
                <form action="{{ route('postDataBaru') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>NKK</th>
                                        <td>
                                            <input class="form-control" type="text" name="nkk" value="" style="text-transform:uppercase">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <td>
                                            <input class="form-control" type="text" name="nik" value="" style="text-transform:uppercase">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>NAMA</th>
                                        <td>
                                            <input class="form-control" type="text" name="nama" value="" style="text-transform:uppercase">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>TEMPAT LAHIR</th>
                                        <td>
                                            <input class="form-control" type="text" name="tempat_l" value="" style="text-transform:uppercase">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>TANGGAL LAHIR</th>
                                        <td>
                                            <input class="form-control" type="date" name="tanggal_l" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>STATUS PERNIKAHAN</th>
                                        <td>
                                            <input class="form-control" type="text" name="status" value="" style="text-transform:uppercase">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>JENIS KELAMIN</th>
                                        <td>
                                            <input class="form-control" type="text" name="jenkel" value="" style="text-transform:uppercase">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>JALAN / DUKUH</th>
                                        <td>
                                            <input class="form-control" type="text" name="jln_dukuh" value="" style="text-transform:uppercase">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>RT</th>
                                        <td>
                                            <input class="form-control" type="number" name="rt" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>RW</th>
                                        <td>
                                            <input class="form-control" type="number" name="rw" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>DISABILITAS</th>
                                        <td>
                                            <div class="">
                                                <select class="form-control" name="disabilitas" id="disabilitas">

                                                    <option value="1">Tidak Cacat</option>
                                                    <option value="2">Tuna Daksa/Cacat Tubuh</option>
                                                    <option value="3">Tuna Netra/Buta</option>
                                                    <option value="4">Cacat Mental Retardasi</option>
                                                    <option value="5"> Tuna Wicara</option>
                                                    <option value="6">Mantan Penderita Gangguan Jiwa</option>
                                                    <option value="7">Tuna Rungu</option>
                                                    <option value="8">Cacat Fisik dan Mental</option>
                                                    <option value="9">Tuna Rungu & Wicara</option>
                                                    <option value="10">Tuna Rungu & Wicara & Cacat Tubuh</option>
                                                    <option value="11">Tuna Rungu & Wicara & Netra & Cacat
                                                        Tubuh</option>
                                                    <option value="12">Tuna Netra & Cacat Tubuh</option>
                                                    <option value="13">Tuna Netra & Rungu & Wicara</option>




                                                    {{-- <option value="1">Meninggal dunia</option>
                                                    <option value="2">Ditemukan data ganda</option>
                                                    <option value="3">Dibawah Umur</option>
                                                    <option value="4">Pindah Domisili</option>
                                                    <option value="5">Tidak Dikenal</option>
                                                    <option value="6">TNI</option>
                                                    <option value="7">Polri</option>
                                                    <option value="8">Hilang ingatan</option>
                                                    <option value="9">Hak Pilih di Cabut</option>
                                                    <option value="10">Bukan Penduduk</option> --}}
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div id="img-container"></div>
                            <div class="row">
                                <h4>Sertakan Dokumen Bukti berupa foto KTP dan KK</h4>
                                <input class="form-control" type="file" id="pendukung" name="pendukung[]" accept="image/*" onchange="updatepreview()"
                                    multiple>
                            </div>
                        </div>
                    </div>
                    <div class="py-2"></div>
                    <div class="row ">
                        <input class="btn btn-primary btn-s" type="submit">
                    </div>
                </form>


            </div>

            <script src="{{ asset('js/app.js') }}"></script>

            <script>
                function updatepreview() {
                    const inpEl = document.getElementById('pendukung')
                    document.getElementById('img-container').innerHTML = ''
                    for (const el of inpEl.files) {
                        let reader = new FileReader()
                        reader.onload = function(e) {
                            const newImg = document.createElement('img')
                            newImg.src = e.target.result
                            newImg.width = 200
                            document.getElementById('img-container').appendChild(newImg)
                        }
                        reader.readAsDataURL(el)
                    }
                }
            </script>
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
