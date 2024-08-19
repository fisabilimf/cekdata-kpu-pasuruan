<html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style1.css') }}">
    <link href="/css/app.css" rel="stylesheet">

</head>

<body>
    <nav class="sidebar">
        <div class="text">Side Menu</div>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li>
                <a href="#">Features
                    <span class="fas fa-arrow-down"></span>
                </a>
            </li>
            <ul>
                <li><a href="#">Pages</a></li>
                <li><a href="#">Pages</a></li>
            </ul>
            </li>
            <li><a href="#">Pages</a></li>
            <li><a href="#">Pages</a></li>
            <li><a href="#">Pages</a></li>
            <li><a href="#">Pages</a></li>
        </ul>
    </nav>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Form Login</title>
    </head>

    <body>
        <div class="isian">
            <form action="insertData" method="POST">
                @csrf
                <fieldset>
                    <legend>MAsukkan Data</legend>
                    <p>
                        <label>Nama :</label>
                        <input type="text" name="Nama" placeholder="" />
                    </p>
                    <p>
                        <label>NIK :</label>
                        <input type="text" name="nik" placeholder="" />
                    </p>
                    <p>
                        <label>NKK :</label>
                        <input type="text" name="nkk" placeholder="" />
                    </p>
                    <p>
                        <label>Tempat Lahir :</label>
                        <input type="text" name="tempat_lahir" placeholder="" />
                    </p>
                    <p>
                        <label>Tanggal Lahir :</label>
                        <input type="date" name="tanggal_lahir" placeholder="" />
                    </p>
                    <p>
                        <!--    <label>Upload Dokumen Pendukung :</label>
                        <input type="file" name="dokumen" placeholder="" />
                    </p> -->
                    <p>
                        <input type="submit" name="submit" value="Submit" />
                    </p>
                </fieldset>
            </form>
        </div>
    </body>

    </html>
    </div>
    </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
