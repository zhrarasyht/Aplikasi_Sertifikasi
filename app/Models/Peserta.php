<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peserta extends Model
{
    protected $table = 'pesertas';

    protected $fillable = [
        'nama_peserta',
        'nisn',
        'jenis_kelamin',
        'email',
        'no_telepon',
        'alamat',
        'skema_sertifikasi_id',
    ];

    public function skemaSertifikasi(): BelongsTo
    {
        return $this->belongsTo(
            SkemaSertifikasi::class,
            'skema_sertifikasi_id'
        );
    }
}
