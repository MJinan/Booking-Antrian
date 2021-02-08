<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('admin/css/vcard.css') }}">

    <title>Document</title>
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
                {!! \DNS1D::getBarcodeHTML($pasien->NOPASIEN, "I25", 3, 45) !!}
            </span>

            <div class="bg-footer"></div>
            <span class="footer">Kartu Ini Harus Dibawa Waktu Berobat</span>
        </div>
    </div>

</body>

</html>
