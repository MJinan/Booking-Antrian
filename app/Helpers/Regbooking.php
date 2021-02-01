<?php

/**
 * 
 */
namespace App\Helpers;

use App\Pasien;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Regbooking
{
    public static function get_NoUrutDr($klinik, $dokter, $tglreg)
    {
        $urutdr = DB::connection('mysql')
                ->table('regbooking')
                ->select(DB::raw('max(NOURUTDR) AS no_urutDr'))
                ->where('KODEBAGIAN', $klinik)
                ->where('KODEDOKTER', $dokter)
                ->where('UTKTGLREG', Carbon::parse($tglreg)->format('Y-m-d'))
                ->first();

        $no_urutdr = $urutdr->no_urutDr+1;

        return $no_urutdr;
    }

    public static function get_alamat()
    {
        $alamat = Pasien::select('ALM1PASIEN')
                    ->where('NOPASIEN', Auth::id())
                    ->first();
        
        return $alamat;
    }

    public static function get_stskawin()
    {
        $kwn = Pasien::select('STKAWIN')
                ->where('NOPASIEN', Auth::id())
                ->first();

        return $kwn;
    }

}