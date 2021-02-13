<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/img/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('admin/css/vcard.css') }}">
    {{-- <style>
        @media (max-width: 500px) {
            body {
                background-color: #42A4FF;
            }

            .card {
                font-family: Share Tech Mono;
                background-color: #ffffff;
                display: block;
                width: 600px;
                height: 330px;
                border-radius: 20px;
                -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 1);
                -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 1);
                box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 1);
                border: 1px solid grey;
                margin: auto;
                position: absolute;
                right: 100px;
            }

            .lg-pemkot {
                position: absolute;
                max-width: 57px;
                padding-top: 10px;
                padding-left: 50px;
            }

            .lg-rsu {
                position: absolute;
                max-width: 72px;
                padding-top: 10px;
                padding-left: 81%;
            }

            .bg-header {
                position: absolute;
                width: 100%;
                height: 100px;
                background: linear-gradient(90deg, #42A4FF 31.25%, #FFFFFF 100%);
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
            }

            .bg-kib {
                position: absolute;
                top: 100px;
                width: 190px;
                height: 36px;
                left: 412px;
                background: #ffbb03;
                border-radius: 0px 0px 0px 30px;
            }

            .bg-footer {
                position: absolute;
                top: 88.5%;
                width: 100%;
                height: 50px;
                background: #ffbb03;
                border-bottom-left-radius: 20px;
                border-bottom-right-radius: 20px;
            }

            .pemkot {
                font-family: Signika;
                text-transform: uppercase;
                color: black;
                font-size: 16px;
                font-weight: 400;
                padding-left: 205px;
                padding-top: 10px;
                position: absolute;
                display: inline-block;
            }

            .rsud {
                font-family: Signika;
                text-transform: uppercase;
                color: black;
                font-size: 16px;
                font-weight: 400;
                padding-left: 183px;
                padding-top: 30px;
                position: absolute;
                display: inline-block;
            }

            .jl {
                font-family: Signika;
                color: black;
                font-size: 16px;
                font-weight: 400;
                padding-left: 148px;
                padding-top: 50px;
                position: absolute;
                display: inline-block;
            }

            .kota {
                font-family: Signika;
                text-transform: uppercase;
                color: black;
                font-size: 16px;
                font-weight: 400;
                padding-left: 271px;
                padding-top: 70px;
                position: absolute;
                display: inline-block;
            }

            .kib {
                font-family: Signika;
                text-transform: uppercase;
                color: black;
                font-size: 16px;
                font-weight: 400;
                padding-left: 450px;
                padding-top: 104px;
                position: absolute;
                display: inline-block;
            }

            .footer {
                font-family: Signika;
                text-transform: uppercase;
                color: black;
                font-size: 30px;
                font-weight: 400;
                padding-left: 63px;
                padding-top: 55%;
                position: absolute;
                display: inline-block;
            }

            .nama {
                font-family: Signika;
                text-transform: uppercase;
                color: black;
                font-size: 25px;
                font-weight: 400;
                padding-left: 50px;
                padding-top: 165px;
                position: absolute;
                display: inline-block;
            }

            .no-rm {
                font-family: Signika;
                text-transform: uppercase;
                color: black;
                font-size: 25px;
                font-weight: 400;
                padding-left: 50px;
                padding-top: 206px;
                position: absolute;
                display: inline-block;
            }

            .jk {
                font-family: Signika;
                text-transform: uppercase;
                color: black;
                font-size: 25px;
                font-weight: 400;
                padding-left: 50px;
                padding-top: 245px;
                position: absolute;
                display: inline-block;
            }

            .barcode {
                padding-left: 67%;
                padding-top: 42%;
                position: absolute;
                display: inline-block;
            }

        }

    </style> --}}

    <title>KIB Pasien</title>
</head>

<body>
    <link href='https://fonts.googleapis.com/css?family=Share+Tech+Mono' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Signika:400' rel='stylesheet' type='text/css'>
    <div class="card-holder">
        <div class="card">
            <div class="bg-header"></div>

            <span class="pemkot">Pemerintah Kota Magelang</span>
            <span class="rsud">
                <strong>Rumah Sakit Umum Daerah Tidar</strong>
            </span>
            <span class="jl">Jl. Tidar No. 30A. Telp (0293) 362260, 362463</span>
            <span class="kota">Magelang</span>

            <img class="lg-pemkot" src="{{ asset('admin/img/pemkot.png') }}">

            <img class="lg-rsu" src="{{ asset('admin/img/rsud.png') }}">

            <div class="bg-kib"></div>
            <span class="kib">
                <strong>Kartu Identitas Berobat</strong>
            </span>

            <span class="nama">{{ $pasien->NAMAPASIEN }}</span>
            <span class="no-rm">{{ $pasien->NOPASIEN }}</span>
            <span class="jk">
                @switch($pasien->JNSKELAMIN)
                @case('P')
                PEREMPUAN
                @break
                @case('L')
                LAKI-LAKI
                @break
                @endswitch
            </span>
            <span class="barcode">
                {!! \DNS1D::getBarcodeHTML($pasien->NOPASIEN, "I25") !!}
            </span>

            <div class="bg-footer"></div>
            <span class="footer">Kartu Ini Harus Dibawa Waktu Berobat</span>
        </div>
    </div>

</body>

</html>
