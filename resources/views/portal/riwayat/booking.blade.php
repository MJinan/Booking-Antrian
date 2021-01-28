@extends('layouts.master')
@section('title', 'History Booking')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Riwayat Pesanan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>No.Booking</th>
                                    <th>Tgl.Pesan</th>
                                    <th>Tgl.Periksa</th>
                                    <th>Klinik</th>
                                    <th>Dokter</th>
                                    <th>Penjamin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hibo as $his)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $his->NOBOOKING }}</td>
                                        <td>{{ Carbon\Carbon::parse($his->TGLPESAN)->translatedFormat('d F Y') }}</td>
                                        <td>{{ Carbon\Carbon::parse($his->UTKTGLREG)->translatedFormat('d F Y') }}</td>
                                        <td>{{ $his->NAMABAGIAN }}</td>
                                        <td>{{ $his->NAMADOKTER }}</td>
                                        <td>{{ $his->NAMAPT }}</td>
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