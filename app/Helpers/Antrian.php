<?php

/**
 * 
 */
namespace App\Helpers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Antrian
{
    public static function get_loket($klinik)
    {
        $loket = DB::connection('mysql')
                ->table('unit')
                ->join('nomor', 'nomor.grpunit', 'unit.grpunit')
                ->select('nomor.*', 'unit.kodeunit')
                ->where('unit.kodeunit', $klinik)
                ->first();

        return $loket;
    }

    public static function get_antri($tglreg, $loket)
    {
        $max_antri = DB::connection('sqlsrv2')
                    ->table('ANTRI')
                    ->select(DB::raw('max(RIGHT(NO_ANTRI, 3)) AS no_antrian'))
                    ->whereDate('TGL_ANTRI', Carbon::parse($tglreg)->format('Y-m-d'))
                    ->where('GRP_LOKET', $loket)
                    ->first();

        $no_antri = $max_antri->no_antrian+1;

        return $no_antri;
    }
}