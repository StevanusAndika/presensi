<?php

namespace App\Models\Model; // Ubah ini

use Illuminate\Database\Eloquent\Model;

class PetaKehadiran extends Model
{
    protected $table = 'peta_kehadiran';

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'no_hari',
        'jam_masuk',
        'jam_keluar'
    ];

    protected $casts = [
        'no_hari' => 'integer',
        'jam_masuk' => 'string',
        'jam_keluar' => 'string'
    ];
}
