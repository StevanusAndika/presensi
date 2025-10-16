<?php

namespace App\Models\Model; // Ubah ini

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'pengguna';

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nip',
        'nama',
        'level',
        'sandi'
    ];

    protected $casts = [
        'nip' => 'string'
    ];

    public function setSandiAttribute($value)
    {
        $this->attributes['sandi'] = md5($value);
    }
}
