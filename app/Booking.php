<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'regbooking';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'NOBOOKING',
        'KODEBAGIAN',
        'KODEDOKTER',
        'WAKTUDR',
        'TYPEPASIEN',
        'NOPASIEN',
        'NAMAPASIEN',
        'TGLLAHIR',
        'JNSKELAMIN',
        'ALM1PASIEN',

        'ALM2PASIEN',
        'KODEPT',
        'UTKTGLREG',
        'JAMDTG',
        'TGLPESAN',
        'JAMPESAN',
        'NOTELP',
        'ALAMATEMAIL',
        'VALID',
        'NOLANTAI',

        'NOKAMAR',
        'NOTT',
        'KDGRPTRF',
        'KDGOLKLS',
        'KDGRKLS',
        'TIPEBOOKING',
        'JNSBOOKING',
        'NOURUTDR',
        'NO_PESERTA',
        'NORJKAN',

        'NOREG',
        'NIK',
        'PPKRUJUKAN',
        'KODEPPKRUJUKAN',
        'POLIRUJUKAN',
        'KODEPOLIRUJUKAN',
        'DIAGRUJUKAN',
        'KODEDIAGRUJUKAN',
        'TGLRUJUKAN',
        'KONTROL',

        'NOKONTROL',
        'UUID',
        'SENDMAIL',
        'KODEKOTA',
        'KODEPROV',
        'KODEKEC',
        'KODEDESA',
        'STKAWIN',
        'STATUSRES'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
