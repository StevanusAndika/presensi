<?php

namespace App\Models\Model; // Ubah ini

use Illuminate\Database\Eloquent\Model;

class PresensiHarian extends Model
{
    protected $table = 'presensi_harian';
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = [
        'tgl_masuk',
        'tgl_pulang',
        'ket_hari',
        'nip',
        'ip_masuk',
        'ip_keluar',
        'peta_kehadiran_id',
        'jam_harus_masuk',
        'jam_harus_pulang'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'nip', 'nip');
    }

    public function petaKehadiran()
    {
        return $this->belongsTo(PetaKehadiran::class, 'peta_kehadiran_id', 'id');
    }
}
