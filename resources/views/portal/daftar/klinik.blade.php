@extends('layouts.master')
@section('title', 'Daftar Klinik')

@section('header')
    <style>
        #col {
            width: 50px;
        }

        br {
            content: "";
            margin: 2em;
            display: block;
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
                    <h4>Daftar Klinik</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('s.form') }}" method="post">
                                {{ csrf_field() }}
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
                                    <label>Klinik <span style="color: red">*</span></label>
                                    <select class="form-control select2 select2-hidden-accessible" name="klinik" id="klinik" tabindex="-1" aria-hidden="true">
                                        <option selected disabled>Pilih Klinik</option>
                                        @foreach ($klinik as $klin)
                                            <option value="{{ $klin->KODEBAGIAN }}">{{ $klin->NAMABAGIAN }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label>Dokter <span style="color: red">*</span></label>
                                    <select class="form-control select2 select2-hidden-accessible" name="dokter" id="dokter" tabindex="-1" aria-hidden="true">
                                        <option selected disabled>Pilih Dokter</option>
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
                        <div class="alert alert-danger alert-dismissible show fade" id="danger">
                            <div class="alert-body">
                              Jika Datang Melebihi Estimasi Jam Datang Akan Dilewati 5 Nomor
                            </div>
                        </div>
                        <div class="alert alert-info">
                            Mohon Screenshoot Detail Pesanan
                        </div>
                        <div class="row">
                            <div class="col-lg-4" style="margin: auto; width: 50%; padding: 10px">
                                <div class="text-center">
                                    {{ $qr }}
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-md">
                                        <tbody>
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
                                                <th scope="row" id="col">Nama</th>
                                                <td>{{ $detail->NAMAPASIEN }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" id="col">Poli Tujuan</th>
                                                <td>{{ $detail->NAMABAGIAN }} <i>~ {{ $lantai->lantai }}</i></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" id="col">Dokter</th>
                                                <td>{{ $detail->NAMADOKTER }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" id="col">Tgl Periksa</th>
                                                <td>
                                                    {{ Carbon\Carbon::parse($detail->UTKTGLREG)->translatedFormat('d F Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" id="col">Estimasi Jam Datang</th>
                                                <td>
                                                    <div style="padding-top: 20px">
                                                        {{ Carbon\Carbon::parse($jamdtg->TGL_ANTRI)->addMinutes(10)->format('H:i:s') }}
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary" id="save">Simpan</button> --}}
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
            setTimeout(function () {
                $('#danger').alert('close');
            }, 6000);
        @endif
    </script>

    <script>
        $(document).ready(function () {
            var todayDate = new Date();
            var maxDate = new Date();

            todayDate.setDate(todayDate.getDate());
            maxDate.setDate(todayDate.getDate()+6);

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
            
            $(document).on('change', '#klinik', function(){
                var kode_bag = $(this).val();
                var utk_tgl = $('#utktgl').val();
                var div = $(this).parent();
    
                var op = "";
    
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('user/dokter')!!}',
                    data:{'id':kode_bag},
                    success:function(data){
                        op += '<option value="0" selected disabled>Pilih Dokter</option>';
                        for(var i = 0; i < data.length; i++){
                            op += '<option value="'+data[i].KODEDOKTER+'">'+data[i].NAMADOKTER+'</option>';
                        }
    
                        div.find('#dokter').html("");
                        div.find('#dokter').append(op);
                    },
                    error:function(){
    
                    }
                });
            });

            $(document).on('change','#dokter',function () {
                var kode_bag = $('#klinik').val();
                var id_dokter = $(this).val();
                var utk_tgl = $('#utktgl').val();

                var a = $(this).parent();

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
            });
        })
    </script>
@stop