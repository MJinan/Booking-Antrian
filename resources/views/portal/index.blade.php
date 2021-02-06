@extends('layouts.master')
@section('title', 'Home')

@section('header')
    <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap4-editable/css/bootstrap-editable.css') }}">    
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Pasien</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row" id="col">No.RM</th>
                                    <td>{{$pasien->NOPASIEN}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" id="col">Nama</th>
                                    <td>
                                        {{$pasien->NAMAPASIEN}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" id="col">Jns.Kelamin</th>
                                    <td>
                                        @switch($pasien->JNSKELAMIN)
                                            @case('P')
                                                PEREMPUAN
                                                @break
                                            @case('L')
                                                LAKI-LAKI
                                                @break                                    
                                        @endswitch
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" id="col">Tempat, Tgl Lahir</th>
                                    <td id="tgl">{{$pasien->TMPLAHIR}}, {{Carbon\Carbon::parse($pasien->TGLLAHIR)->translatedFormat('d F Y')}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" id="col">Alamat</th>
                                    <td>{{$pasien->ALAMAT}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" id="col">No.KIS</th>
                                    <td>{{$pasien->NIKPGJWB}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" id="col">No.KTP</th>
                                    <td>{{$pasien->NIK}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">No.HP</th>
                                    <td>
                                        <a href="#" id="no_telp" data-type="text" data-pk="{{Auth::id()}}" data-url="/api/update/{{Auth::id()}}/telp" data-title="Enter No.HP">
                                            {{$pasien->TLPPASIEN}}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" id="col">Email</th>
                                    <td>
                                        <a href="#" id="email" data-type="email" data-pk="{{Auth::id()}}" data-url="/api/update/{{Auth::id()}}/email" data-title="Enter Email">
                                            {{$pasien->EMAIL}}
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script src="{{ asset('admin/vendor/bootstrap4-editable/js/bootstrap-editable.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#email').editable();
            $('#no_telp').editable({
                validate: function(value) {
                    if ($.trim(value) == '') {
                        return 'This field is required';
                    } else if ($.isNumeric(value) == '') {
                        return 'Hanya Nomor Yang Diisikan';
                    } else if(value.length < 11) {
                        return 'Minimal 11 Digit';
                    } else if(value.length > 13) {
                        return 'Maximal 13 Digit';
                    }
                }
            });
        });
    </script>
@stop