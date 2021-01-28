<?php

namespace App\Http\Controllers;

use App\Booking;
use App\login_pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Generator;

class PortalController extends Controller
{
    public function index(Request $req)
    {
        $pasien = login_pasien::where('NOPASIEN', Auth::id())
                ->first();

        return view('portal.index', compact('pasien'));
    }

    public function rajal()
    {
        $rajal = DB::connection('sqlsrv')
                ->table('REGDR')
                ->join('REGPAS', 'REGPAS.NOREG', 'REGDR.NOREG')
                ->join('BAGIAN', 'BAGIAN.KODEBAGIAN', 'REGDR.BAGREGDR')
                ->join('DOKTER', 'REGDR.KODEDOKTER', 'DOKTER.KODEDOKTER')
                ->select('REGDR.NOREG', 'REGPAS.TGLREG', 'BAGIAN.NAMABAGIAN', 'DOKTER.NAMADOKTER')
                ->orderby('REGPAS.TGLREG', 'DESC')
                ->where('REGPAS.REGAHIR', null)
                ->where('REGPAS.NOPASIEN', Auth::id())
                ->get();

        return view('portal.riwayat.rajal', compact('rajal'));
    }

    public function ranap()
    {
        $ranap = DB::connection('sqlsrv')
                ->table('REGRWI')
                ->join('REGPAS', 'REGPAS.NOREG', 'REGRWI.NOREG')
                ->join('PASIEN', 'REGPAS.NOPASIEN', 'PASIEN.NOPASIEN')
                ->join('BAGIAN', 'REGRWI.KODEBAGIAN', 'BAGIAN.KODEBAGIAN')
                ->join('DOKTER', 'DOKTER.KODEDOKTER', 'REGRWI.DRPGJWB')
                ->select('REGRWI.NOREG', 'REGRWI.TGLMASUK', 'REGRWI.TGLPULANG', 'BAGIAN.NAMABAGIAN', 'DOKTER.NAMADOKTER')
                ->orderby('REGPAS.TGLREG', 'DESC')
                ->where('REGPAS.NOPASIEN', Auth::id())
                ->get();

        return view('portal.riwayat.ranap', compact('ranap'));
    }

    public function hibooking()
    {
        $hibo = DB::connection('mysql')
                ->table('vw_refbooking')
                ->where('NOPASIEN', Auth::id())
                ->select('NOBOOKING', 'NOPASIEN', 'NAMAPASIEN', 'NAMADOKTER', 'NAMABAGIAN', 'NAMAPT', 'TGLPESAN', 'UTKTGLREG', DB::raw('count(*) as total'))
                ->groupBy('NOBOOKING', 'NOPASIEN', 'NAMAPASIEN', 'NAMADOKTER', 'NAMABAGIAN', 'NAMAPT', 'TGLPESAN', 'UTKTGLREG')
                ->orderBy('TGLPESAN', 'DESC')
                ->get();

        return view('portal.riwayat.booking', compact('hibo'));
    }

    public function dftr_klinik()
    {
        $klinik = DB::connection('mysql')
                ->table('vw_jadwal')
                ->where('JNSBAGIAN', '01')
                ->select('KODEBAGIAN', 'NAMABAGIAN', DB::raw('count(*) as total'))
                ->groupBy('KODEBAGIAN', 'NAMABAGIAN')
                ->orderBy('KODEBAGIAN', 'ASC')
                ->get();
        
        $penjamin = DB::connection('mysql')
                    ->table('tblpt')
                    ->where('STSAKTIF', 'A')
                    ->get();

        $n_book = Booking::select('NOBOOKING')
                ->where('NOPASIEN', Auth::id())
                ->where('TGLPESAN', Carbon::now()->format('Y-m-d'))
                ->latest('JAMPESAN')
                ->first();

        if ($n_book != null) {
            $detail = Booking::join('tbljadwal', 'regbooking.KODEDOKTER', 'tbljadwal.KODEDOKTER')
                ->join('tblbagian', 'regbooking.KODEBAGIAN', 'tblbagian.KODEBAGIAN')
                ->select('regbooking.NOBOOKING', 'regbooking.NOPASIEN', 'regbooking.NAMAPASIEN', 'regbooking.UTKTGLREG', 'tbljadwal.NAMADOKTER', 'tblbagian.NAMABAGIAN')
                ->where('regbooking.NOBOOKING', $n_book->NOBOOKING)
                ->first();
        } else {
            $detail = null;
        }

        $qrcode = new Generator;
        if ($n_book != null) {
            $qr = $qrcode->size(180)->generate($n_book->NOBOOKING);
        } else {
            $qr = null;
        }

        return view('portal.daftar.klinik') -> with([
            'klinik'   => $klinik,
            'penjamin' => $penjamin,
            'detail'   => $detail,
            'qr'       => $qr
        ]);
    }

    public function dftr_dokter()
    {
        $dokter = DB::connection('mysql')
                ->table('vw_jadwal')
                ->select('KODEDOKTER', 'NAMADOKTER', DB::raw('count(*) as total'))
                ->groupBy('KODEDOKTER', 'NAMADOKTER')
                ->orderBy('NAMADOKTER', 'ASC')
                ->get();
        
        $penjamin = DB::connection('mysql')
                    ->table('tblpt')
                    ->where('STSAKTIF', 'A')
                    ->get();

        $nomor = DB::connection('mysql')
                ->table('regbooking')
                ->select(DB::raw('max(RIGHT(NOBOOKING, 3)) AS nomor'))
                ->where('TGLPESAN', Carbon::now()->format('Y-m-d'))
                ->get();

        $n_book = Booking::select('NOBOOKING')
                ->where('NOPASIEN', Auth::id())
                ->where('TGLPESAN', Carbon::now()->format('Y-m-d'))
                ->latest('JAMPESAN')
                ->first();

        if ($n_book != null) {
            $detail = Booking::join('tbljadwal', 'regbooking.KODEDOKTER', 'tbljadwal.KODEDOKTER')
                ->join('tblbagian', 'regbooking.KODEBAGIAN', 'tblbagian.KODEBAGIAN')
                ->select('regbooking.NOBOOKING', 'regbooking.NOPASIEN', 'regbooking.NAMAPASIEN', 'regbooking.UTKTGLREG', 'tbljadwal.NAMADOKTER', 'tblbagian.NAMABAGIAN')
                ->where('regbooking.NOBOOKING', $n_book->NOBOOKING)
                ->first();
        } else {
            $detail = null;
        }

        $qrcode = new Generator;
        if ($n_book != null) {
            $qr = $qrcode->size(200)->generate($n_book->NOBOOKING);
        } else {
            $qr = null;
        }

        return view('portal.daftar.dokter') -> with([
            'dokter'   => $dokter,
            'penjamin' => $penjamin,
            'nomor'    => $nomor,
            'detail'   => $detail,
            'qr'       => $qr
        ]);
    }

    public function nobooking()
    {
        $nomor = DB::connection('mysql')
            ->table('regbooking')
            ->select(DB::raw('max(RIGHT(NOBOOKING, 3)) AS nomor'))
            ->where('TGLPESAN', Carbon::now()->format('Y-m-d'))
            ->get();

        return response()->json($nomor);
    }

    public function nourut(Request $req)
    {
        $data = DB::connection('mysql')
            ->table('regbooking')
            ->select(DB::raw('max(NOURUTDR) AS nomor'))
            ->where('KODEBAGIAN', $req->bag_id)
            ->where('KODEDOKTER', $req->dok_id)
            ->where('UTKTGLREG', Carbon::parse($req->utk_tgl)->format('Y-m-d'))
            ->get();

        return response()->json($data);
    }
}
