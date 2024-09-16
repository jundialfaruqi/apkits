<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kesimpulan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'isi_kesimpulan',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $table = 'kesimpulans';
}
