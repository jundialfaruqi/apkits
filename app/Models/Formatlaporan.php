<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formatlaporan extends Model
{
    use HasFactory;
    protected $fillable = [
        'opd_id',
        'pekerjaan_id',
        'bidang',
        'pekerjaan',
        'kabid',
        'jabatan',
        'nip',
        'latar_belakang',
        'maksud_tujuan',
        'ruang_lingkup',
        'logo_dinas',
    ];

    protected $table = 'formatlaporans';

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pekerjaanRelasi()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id');
    }
}
