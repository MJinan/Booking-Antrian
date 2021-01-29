<?php

/**
 * 
 */
namespace App\Helpers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Regbooking
{
    public static function get_booking()
    {
        $max_book = DB::connection('mysql')
                    ->table('regbooking')
                    ->select(DB::raw('max(RIGHT(NOBOOKING, 3)) AS no_booking'))
                    ->where('TGLPESAN', Carbon::now()->format('Y-m-d'))
                    ->get();

        return $max_book;
    }

    public static function get_NoUrutDr($klinik, $dokter, $tglreg)
    {
        $urutdr = DB::connection('mysql')
                ->table('regbooking')
                ->select(DB::raw('max(NOURUTDR) AS no_urutDr'))
                ->where('KODEBAGIAN', $klinik)
                ->where('KODEDOKTER', $dokter)
                ->where('UTKTGLREG', Carbon::parse($tglreg)->format('Y-m-d'))
                ->get();

        return $urutdr;
    }
}