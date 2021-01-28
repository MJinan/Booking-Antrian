@extends('layouts.master')
@section('title', 'Riwayat Rawat Inap')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Riwayat Rawat Inap</h4>
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
                                    <th>Tgl.Masuk</th>
                                    <th>Tgl.Pulang</th>
                                    <th>Ruang</th>
                                    <th>Dokter</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ranap as $ran)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ $ran->NOREG }}</td>
                                    <td>{{ Carbon\Carbon::parse($ran->TGLMASUK)->translatedFormat('d F Y') }}</td>
                                    <td>{{ Carbon\Carbon::parse($ran->TGLPULANG)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $ran->NAMABAGIAN }}</td>
                                    <td>{{ $ran->NAMADOKTER }}</td>
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