@extends('layouts.master')
@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Jadwak Dokter</h4>
                </div>
                <div class="card-body">
                    <iframe type="application/pdf" src="{{asset('pdf/poliklinik.pdf')}}" frameborder="0" width="100%" height="600"></iframe>
                </div>
            </div>
        </div>
    </div>
@stop