@extends('layouts.master')
@section('title', 'Riwayat Rawat Jalan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Riwayat Rawat Jalan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>No.Reg</th>
                                    <th>Tgl.Periksa</th>
                                    <th>Klinik</th>
                                    <th>Dokter</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rajal as $ra)
                                    <tr>
                                        <th class="text-center">
                                            {{$loop->iteration}}
                                        </th>
                                        <td>{{$ra->NOREG}}</td>
                                        <td>{{Carbon\Carbon::parse($ra->TGLREG)->translatedFormat('d F Y')}}</td>
                                        <td>{{$ra->NAMABAGIAN}}</td>
                                        <td>{{$ra->NAMADOKTER}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop