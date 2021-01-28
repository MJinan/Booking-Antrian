<?php

namespace App\Http\Controllers;

use App\Pasien;
use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProsesController extends Controller
{
    public function update_em(Request $req, $id)
    {
        $field = [
            'EMAIL' => $req->value
        ];

        $pasien = Pasien::where('NOPASIEN', $id)
                ->update($field);
    }

    public function update_telp(Request $req, $id)
    {
        $field = [
            'TLPPASIEN' => $req->value
        ];

        $pasien = Pasien::where('NOPASIEN', $id)
                ->update($field);
    }

    public function find_dokter(Request $req)
    {
        $dokter = DB::connection('mysql')
                ->table('vw_jadwal')
                ->where('KODEBAGIAN', $req->id)
                ->select('KODEDOKTER', 'NAMADOKTER', DB::raw('count(*) as total'))
                ->groupBy('KODEDOKTER', 'NAMADOKTER')
                ->get();

        return response()->json($dokter);
    }

    public function jdwl_dokter(Request $req)
    {
        $data = DB::connection('mysql')
                ->table('vw_jadwal')
                ->where('KODEDOKTER', $req->dokter_id)
                ->where('KODEBAGIAN', $req->bag_id)
                ->orderBy('KODEWAKTU', 'ASC')
                ->get();

        return response()->json($data);
    }

    public function save_form(Request $req)
    {
        $this->validate($req, [
            'penjamin'  => 'required',
            'tglreg'    => 'required',
            'klinik'    => 'required',
            'dokter'    => 'required',
            'norujukan' => 'nullable'
        ]);

        $alamat = Pasien::select('ALM1PASIEN')
                ->where('NOPASIEN', Auth::id())
                ->first();

        $kwn = Pasien::select('STKAWIN')
                ->where('NOPASIEN', Auth::id())
                ->first();

        $date = Carbon::parse($req->tglreg)->format('ymd');
        $no_antrian = 'A'.sprintf("%03d", $req->nobooking+1);

        $nourutdr = $req->nourutdr+1;

        $field = [
            'NOBOOKING' => $date.$no_antrian,
            'KODEBAGIAN' => $req->klinik,
            'KODEDOKTER' => $req->dokter,
            'WAKTUDR' => 'P',
            'TYPEPASIEN' => 'L',
            'NOPASIEN' => Auth::id(),
            'NAMAPASIEN' => Auth::user()->NAMAPASIEN,
            'TGLLAHIR' => Auth::user()->TGLLAHIR,
            'JNSKELAMIN' => Auth::user()->JNSKELAMIN,
            'ALM1PASIEN' => $alamat->ALM1PASIEN,

            'ALM2PASIEN' => null,
            'KODEPT' => $req->penjamin,
            'UTKTGLREG' => $req->tglreg,
            'JAMDTG' => Carbon::parse("$req->tglreg 00:00:00")->format('Y-m-d H:i:s'),
            'TGLPESAN' => Carbon::now()->translatedFormat('Y-m-d'),
            'JAMPESAN' => Carbon::now()->translatedFormat('H:i:s'),
            'NOTELP' => Auth::user()->TLPPASIEN,
            'ALAMATEMAIL' => Auth::user()->EMAIL,
            'VALID' => 'E',
            'NOLANTAI' => null,

            'NOKAMAR' => null,
            'NOTT' => null,
            'KDGRPTRF' => null,
            'KDGOLKLS' => null,
            'KDGRKLS' => null,
            'TIPEBOOKING' => 'J',
            'JNSBOOKING' => 1,

            'NOURUTDR' => $nourutdr,

            'NO_PESERTA' => $req->no_peserta,
            'NORJKAN' => $req->norujukan,

            'NOREG' => null,
            'NIK' => Auth::user()->NIK,
            'PPKRUJUKAN' => 0,
            'KODEPPKRUJUKAN' => 0,
            'POLIRUJUKAN' => 0,
            'KODEPOLIRUJUKAN' => 0,
            'DIAGRUJUKAN' => 0,
            'KODEDIAGRUJUKAN' => 0,
            'TGLRUJUKAN' => null,
            'KONTROL' => null,

            'NOKONTROL' => 0,
            'UUID' => null,
            'SENDMAIL' => null,
            'KODEKOTA' => Auth::user()->KODEKOTA,
            'KODEPROV' => Auth::user()->KODEPROV,
            'KODEKEC' => Auth::user()->KODEKEC,
            'KODEDESA' => Auth::user()->KODEDESA,
            'STKAWIN' => $kwn->STKAWIN,
            'STATUSRES' => 0
        ]; 

        $result = Booking::create($field);

        if ($result) {
            return back() -> with('sukses', 'Berhasil Daftar');
        } else {
            return back() -> with('error', 'Gagal Daftar');
        }
    }

    public function find_klinik(Request $req)
    {
        $klinik = DB::connection('mysql')
                ->table('vw_jadwal')
                ->where('KODEDOKTER', $req->id)
                ->select('KODEBAGIAN', 'NAMABAGIAN', DB::raw('count(*) as total'))
                ->groupBy('KODEBAGIAN', 'NAMABAGIAN')
                ->get();

        return response()->json($klinik);
    }

    /* public function send()
    {
        $booking = Booking::where('STATUSRES', 0)
                    ->get();

        $field = [];
        foreach ($booking as $book) {
            $field[] = [
                'NOBOOKING' => $book->NOBOOKING,
                'KODEBAGIAN' => $book->KODEBAGIAN,
                'KODEDOKTER' => $book->KODEDOKTER,
                'WAKTUDR' => $book->WAKTUDR,
                'TYPEPASIEN' => $book->TYPEPASIEN,
                'NOPASIEN' => $book->NOPASIEN,
                'NAMAPASIEN' => $book->NAMAPASIEN,
                'TGLLAHIR' => $book->TGLLAHIR,
                'JNSKELAMIN' => $book->JNSKELAMIN,
                'ALM1PASIEN' => $book->ALM1PASIEN,
    
                'ALM2PASIEN' => $book->ALM2PASIEN,
                'KODEPT' => $book->KODEPT,
                'UTKTGLREG' => $book->UTKTGLREG,
                'JAMDTG' => $book->JAMDTG,
                'TGLPESAN' => $book->TGLPESAN,
                'JAMPESAN' => $book->JAMPESAN,
                'NOTELP' => $book->NOTELP,
                'ALAMATEMAIL' => $book->ALAMATEMAIL,
                'VALID' => $book->VALID,
                'NOLANTAI' => $book->NOLANTAI,
    
                'NOKAMAR' => $book->NOKAMAR,
                'NOTT' => $book->NOTT,
                'KDGRPTRF' => $book->KDGRPTRF,
                'KDGOLKLS' => $book->KDGOLKLS,
                'KDGRKLS' => $book->KDGRKLS,
                'TIPEBOOKING' => $book->TIPEBOOKING,
                'JNSBOOKING' => $book->JNSBOOKING,
                'NOURUTDR' => $book->NOURUTDR,
                'NO_PESERTA' => $book->NO_PESERTA,
                'NORJKAN' => $book->NORJKAN,
    
                'NOREG' => $book->NOREG,
                'NIK' => $book->NIK,
                'PPKRUJUKAN' => $book->PPKRUJUKAN,
                'KODEPPKRUJUKAN' => $book->KODEPPKRUJUKAN,
                'POLIRUJUKAN' => $book->POLIRUJUKAN,
                'KODEPOLIRUJUKAN' => $book->KODEPOLIRUJUKAN,
                'DIAGRUJUKAN' => $book->DIAGRUJUKAN,
                'KODEDIAGRUJUKAN' => $book->KODEDIAGRUJUKAN,
                'TGLRUJUKAN' => $book->TGLRUJUKAN,
                'KONTROL' => $book->KONTROL,
    
                'NOKONTROL' => $book->NOKONTROL,
                'UUID' => $book->UUID,
                'KODEPROV' => $book->KODEPROV,
                'KODEKOTA' => $book->KODEKOTA,
                'KODEKEC' => $book->KODEKEC,
                'KODEDESA' => $book->KODEDESA,
                'STKAWIN' => $book->STKAWIN
            ];
        }

        DB::connection('sqlsrv')
            ->table('REGBOOKING')
            ->insert($field);

        $reg = DB::connection('sqlsrv')
                ->table('REGBOOKING')
                ->get();
        
        $chk = [];
        foreach ($reg as $re) {
            $chk[] = $re->NOBOOKING;
        }
        
        Booking::whereIn('NOBOOKING', $chk)->update(['STATUSRES' => 1]);

    } */

}
