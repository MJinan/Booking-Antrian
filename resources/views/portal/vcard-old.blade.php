@extends('layouts.master')
@section('title', 'KIB Pasien')

@section('header')
    <style>
        #kib-nama {
            position: absolute;
            left: 5%;
            top: 65%;
            color: black;
        }
        #kib-rm {
            position: absolute;
            left: 5%;
            top: 70%;
            color: black;
        }
        #kib-jk {
            position: absolute;
            left: 5%;
            top: 75%;
            color: black;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>KIB Pasien</h4>
                </div>
                <div class="card-body">
                    <img src="{{ asset('admin/img/KIB.png') }}" class="img-fluid" alt="Responsive image" style="max-width: 80%;">
                    <h6 id="kib-nama">
                        {{ $pasien->NAMAPASIEN }}
                    </h6>
                    <h6 id="kib-rm">
                        {{$pasien->NOPASIEN}}
                    </h6>
                    <h6 id="kib-jk">
                        {{$pasien->JNSKELAMIN}}
                    </h6>
                </div>
            </div>
        </div>
    </div>
@stop