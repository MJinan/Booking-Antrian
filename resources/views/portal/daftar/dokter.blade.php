@extends('layouts.master')
@section('title', 'Daftar Dokter')

@section('header')
    <style>
        #klinik, #l_klinik, #bagian {
            display: none;
        }
        br {
            content: "";
            margin: 2em;
            display: block;
        }

        #col {
            width: 20px;
        }
        #no_book {
            background-color: white;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Dokter</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('s.form') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" id="nobooking" name="nobooking">
                                <input type="hidden" id="nourut_dr" name="nourutdr">
                                <div class="form-group">
                                    <label>Untuk Tgl <span style="color: red">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control datepicker" name="tglreg" id="utktgl" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Penjamin <span style="color: red">*</span></label>
                                    <select class="form-control select2 select2-hidden-accessible" name="penjamin" tabindex="-1" aria-hidden="true">
                                        <option selected disabled>Pilih Penjamin</option>
                                        @foreach ($penjamin as $penj)
                                            <option value="{{ $penj->KODEPT }}">{{ $penj->NAMAPT }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" class="form-control" name="no_peserta" value="{{Auth::user()->NIKPGJWB}}">
                                </div>
                                <div class="form-group">
                                    <label>Dokter <span style="color: red">*</span></label>
                                    <select class="form-control select2 select2-hidden-accessible" name="dokter" id="dokter" tabindex="-1" aria-hidden="true">
                                        <option selected disabled>Pilih Dokter</option>
                                        @foreach ($dokter as $dok)
                                            <option value="{{ $dok->KODEDOKTER }}">{{ $dok->NAMADOKTER }}</option>
                                        @endforeach
                                    </select>
                                    <div id="bagian" class="mt-2"></div>
                                    <br>
                                    <label id="l_klinik">Klinik <span style="color: red">*</span></label>
                                    <select class="form-control select2 select2-hidden-accessible" name="klinik" id="klinik" tabindex="-1" aria-hidden="true">
                                        <option selected disabled>Pilih Klinik</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>No Rujukan</label>
                                    <input type="text" class="form-control" name="norujukan">
                                </div>
                                <button type="submit" class="btn btn-success" id="btnSubmit" disabled>
                                    <i class="fas fa-check"></i> Daftar
                                </button>
                            </form>
                        </div>
                        
                        {{-- <div class="col-lg-6">
                            <br>
                            <div class="table-responsive" id="jadwal">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama Dokter</th>
                                            <th scope="col">Waktu</th>
                                            <th scope="col">Hari</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="alert alert-info mt-3">
                                                        Pilihlah <strong>KLINIK TUJUAN &amp; DOKTER</strong> terlebih dahulu.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                </table>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('modal')
    @if (Session::has('sukses'))
        <div class="modal fade" id="detailPesanan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                        </button>
                    </div>
                    <div class="modal-body" id="no_book">
                        <div class="row">
                            <div class="col-lg-4" style="margin: auto; width: 50%; padding: 10px">
                                <div class="text-center">
                                    {!! QrCode::size(180)->generate('COBA QR CODE'); !!}
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <tr>
                                                    <th scope="row" id="col">No.Booking</th>
                                                    <td>{{ $detail->NOBOOKING }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" id="col">No.RM</th>
                                                    <td>
                                                        {{ $detail->NOPASIEN }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" id="col">Nama Pasien</th>
                                                    <td>{{ $detail->NAMAPASIEN }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" id="col">Poli Tujuan</th>
                                                    <td>{{ $detail->NAMABAGIAN }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" id="col">Nama Dokter</th>
                                                    <td>{{ $detail->NAMADOKTER }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" id="col">Tgl Periksa</th>
                                                    <td>
                                                        {{ Carbon\Carbon::parse($detail->UTKTGLREG)->translatedFormat('d F Y') }}
                                                    </td>
                                                </tr>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="save">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop

@section('footer')
    <script src="{{asset('admin/vendor/html2canvas/js/html2canvas.min.js')}}"></script>
    <script src="{{asset('admin/vendor/html2canvas/js/canvas2image.js')}}"></script>

    <script>
        @if (count($errors) > 0)
            swal('Warning', 'Penjamin, Klinik, & Dokter Wajib Diisi', 'warning');
        @endif

        @if(Session::has('sukses'))
            $('#detailPesanan').modal('show');
        @endif
    </script>

    <script>
        $(document).ready(function () {
            var todayDate = new Date();
            var maxDate = new Date();

            todayDate.setDate(todayDate.getDate()+1);
            maxDate.setDate(todayDate.getDate()+5);

            $('.datepicker').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                singleDatePicker: true,
                minDate: todayDate,
                maxDate: maxDate,
                isInvalidDate: function(date) {
                    return (date.day() == 0);
                }
            });

            $(".select2").select2();

            $('#klinik').next(".select2-container").hide();

            $.ajax({
                type:'get',
                url:'{!!URL::to('user/nobooking')!!}',
                success:function(data){
                    $('#nobooking').val(data[0].nomor);
                }
            });

            $(document).on('change','#dokter',function(){
                var kode_dok = $(this).val();
                var div = $(this).parent();

                var utk_tgl = $('#utktgl').val();
                
                var sp = " ";
                var op = " ";
                var tab = " ";

                $.ajax({
                    type:'get',
                    url:'{!!URL::to('user/klinik')!!}',
                    data:{'id':kode_dok},
                    success:function(data){
                        console.log(data.length);
                        if (data.length == 1) {
                            $('#klinik').next(".select2-container").hide();
                            $('#l_klinik').hide();

                            $('#bagian').attr("style", "display:block");
                            
                            for(var i = 0; i < data.length; i++){
                                sp += '<span class="badge badge-primary">'
                                        +data[i].NAMABAGIAN+
                                   '</span>';

                                op += '<option value="'+data[i].KODEBAGIAN+'" selected>'+data[i].NAMABAGIAN+'</option>';
                            }

                            $('#bagian').html(" ");
                            $('#bagian').html(sp);

                            div.find('#klinik').html(" ");
                            div.find('#klinik').append(op);

                            $.ajax({
                                type:'get',
                                url:'{!!URL::to('user/nourut')!!}',
                                data:{'utk_tgl':utk_tgl, 'dok_id':kode_dok, 'bag_id':$('#klinik').val()},
                                dataType:'json',//return data will be json
                                success:function(data) {
                                    $('#nourut_dr').val(data[0].nomor);
                                }
                            });

                            /* $.ajax({
                                type:'get',
                                url:'{!!URL::to('user/jdwl_dokter')!!}',
                                data:{'dokter_id':kode_dok, 'bag_id':$('#klinik').val()},
                                dataType:'json',//return data will be json
                                success:function(data) {
                                        tab += '<table class="table table-bordered">';
                                            tab += '<thead>';
                                                tab += '<tr>';
                                                    tab += '<th scope="col">Nama Dokter</th>';
                                                    tab += '<th scope="col">Waktu</th>';
                                                    tab += '<th scope="col">Hari</th>';
                                                tab += '</tr>';
                                            tab += '</thead>';
                                            tab += '<tbody>';
                                                for(var i = 0; i < data.length; i++){
                                                    tab += '<tr>';
                                                        tab += '<td>'+data[i].NAMADOKTER+'</td>';
                                                        var kode = data[i].KODEWAKTU;
                                                        switch (kode){
                                                            case "P":
                                                                waktu = "Pagi";
                                                                break;
                                                            case "S":
                                                                waktu = "Siang";
                                                                break;
                                                            case "M":
                                                                waktu = "Malam";
                                                                break;
                                                        }
                                                        tab += '<td>'+waktu+'</td>';
                                                    tab += '<td>'+data[i].keterangan+'</td>';
                                                tab += '</tr>';
                                                }
                                            tab += '</tbody>';
                                        tab += '</table>';
                                    
                                    $('#jadwal').html(" ");
                                    $('#jadwal').html(tab);

                                }
                            }); */

                            setTimeout(function () {
                                $('#btnSubmit').attr('disabled', false);
                            }, 700);

                        } else {
                            op += '<option value="0" selected disabled>Pilih Klinik</option>';
                            for(var i = 0; i < data.length; i++){
                                op += '<option value="'+data[i].KODEBAGIAN+'">'+data[i].NAMABAGIAN+'</option>';
                            }

                            $('#bagian').hide();

                            $('#l_klinik').attr("style", "display:block");
                            $('#klinik').next(".select2-container").show();

                            div.find('#klinik').html(" ");
                            div.find('#klinik').append(op);

                            /* tab += '<table class="table table-bordered">';
                                tab += '<thead>';
                                    tab += '<tr>';
                                        tab += '<th scope="col">Nama Dokter</th>';
                                        tab += '<th scope="col">Waktu</th>';
                                        tab += '<th scope="col">Hari</th>';
                                    tab += '</tr>';
                                tab += '</thead>';
                                tab += '<tbody>';
                                        tab += '<tr>';
                                            tab += '<td colspan = "3"><div class="alert alert-info mt-3">Pilihlah <strong>KLINIK TUJUAN &amp; DOKTER</strong> terlebih dahulu.</div></td>';
                                    tab += '</tr>';
                                tab += '</tbody>';
                            tab += '</table>';

                            $('#jadwal').html(" ");
                            $('#jadwal').html(tab); */
                        }
                    }
                });
            });

            $(document).on('change','#klinik',function () {
                var kode_bag = $(this).val();
                var id_dokter = $('#dokter').val();
                var utk_tgl = $('#utktgl').val();

                var tab = " ";

                $.ajax({
                    type:'get',
                    url:'{!!URL::to('user/nourut')!!}',
                    data:{'utk_tgl':utk_tgl, 'dok_id':id_dokter, 'bag_id':kode_bag},
                    dataType:'json',//return data will be json
                    success:function(data) {
                        $('#nourut_dr').val(data[0].nomor);
                    }
                });

                /* $.ajax({
                    type:'get',
                    url:'{!!URL::to('user/jdwl_dokter')!!}',
                    data:{'dokter_id':id_dokter, 'bag_id':kode_bag},
                    dataType:'json',//return data will be json
                    success:function(data) {
                        tab += '<table class="table table-bordered">';
                            tab += '<thead>';
                                tab += '<tr>';
                                    tab += '<th scope="col">Nama Dokter</th>';
                                    tab += '<th scope="col">Waktu</th>';
                                    tab += '<th scope="col">Hari</th>';
                                tab += '</tr>';
                            tab += '</thead>';
                            tab += '<tbody>';
                                for(var i = 0; i < data.length; i++){
                                    tab += '<tr>';
                                        tab += '<td>'+data[i].NAMADOKTER+'</td>';
                                        var kode = data[i].KODEWAKTU;
                                        switch (kode){
                                            case "P":
                                                waktu = "Pagi";
                                                break;
                                            case "S":
                                                waktu = "Siang";
                                                break;
                                            case "M":
                                                waktu = "Malam";
                                                break;
                                        }
                                        tab += '<td>'+waktu+'</td>';
                                    tab += '<td>'+data[i].keterangan+'</td>';
                                tab += '</tr>';
                                }
                            tab += '</tbody>';
                        tab += '</table>';
                        
                        $('#jadwal').html(" ");
                        $('#jadwal').html(tab);

                    },
                    error:function(){

                    }
                }); */

                setTimeout(function () {
                    $('#btnSubmit').attr('disabled', false);
                }, 700);
            });
        });
    </script>

    <script>
        $('#save').click(function() {
            var elm = $('#no_book').get(0);
            var lebar = "750";
            var tinggi = "500";
            var type = "jpg";
            var filename = "Nomor-Booking";
            html2canvas(elm).then(function(canvas) {
                var canvasWidth = canvas.width;
                var canvasHeight = canvas.height;

                Canvas2Image.saveAsImage(canvas, lebar, tinggi, type, filename);
            })
        })
    </script>
@stop