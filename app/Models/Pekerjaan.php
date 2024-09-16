<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];

    protected $table = 'pekerjaans';

    public function formatlaporans()
    {
        return $this->hasMany(Formatlaporan::class, 'pekerjaan_id');
    }
}
