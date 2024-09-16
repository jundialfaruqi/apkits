<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rancangan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kegiatan_id',
        'jenis_kegiatan',
        'tanggal',
        'tempat',
        'pelaksanaan_kerja',
        'progress',
        'foto',
    ];

    protected $table = 'rancangans';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function kesimpulan()
    {
        return $this->belongsTo(Kesimpulan::class);
    }
}
