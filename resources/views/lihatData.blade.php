


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <style type="text/css">
        .col-4{
            padding-left: 200px;
            padding-top: 250px;
        }



        </style>
    <title>Tampil data</title>
  </head>
  <body>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
    <div class="container">
        <div class="col-4"></div>
        <div class="col-4">
    <table class="table table-bordered scrollspy-example">
      <thead>
        <tr>
            <th>Nama</th>
            <th>NKK</th>
            <th>NIK</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Status</th>
            <th>Jenkel</th>
            <th>RT</th>
            <th>RW</th>
            <th>Disabilitas</th>
            <th>Jenkel</th>
            <th>TPS</th>
        </tr>
<<<<<<< HEAD
      </thead>
      <tbody>
=======
>>>>>>> 2035fac81fbbd5f39c9eadf5e2ceb91aa5d2527d
        @foreach ($data_pemilih as $pemilih )


        <tr>
            <td>{{$pemilih->nama}}</td>
            <td>{{$pemilih->nkk}}</td>
            <td>{{$pemilih->nik}}</td>
            <td>{{$pemilih->tempat_l}}</td>
            <td>{{$pemilih->tanggal_l}}</td>
            <td>{{$pemilih->status}}</td>
            <td>{{$pemilih->jenkel}}</td>
            <td>{{$pemilih->rt}}</td>
            <td>{{$pemilih->rw}}</td>
            <td>{{$pemilih->disabilitas}}</td>
            <td>{{$pemilih->tps}}</td>
        </tr>
        @endforeach
      </tbody>
</table>
</div>
</div>
<<<<<<< HEAD
=======
    <?php
    $no=1;
    // $ambildata=mysqli_query
    ?>
>>>>>>> 2035fac81fbbd5f39c9eadf5e2ceb91aa5d2527d
  </body>
</html>
