<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materi'; // Pastikan nama tabel diatur dengan benar

    protected $guarded = [
        'id',
    ];

    public function quis()
    {
        return $this->hasMany(Quis::class);
    }
    public function userJawabQuis()
    {
        return $this->hasMany(UserJawabQuis::class, 'materi_id', 'id');
    }
}
