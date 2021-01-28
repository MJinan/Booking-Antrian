<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
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
    protected $table = 'PASIEN';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['TLPPASIEN', 'EMAIL'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
