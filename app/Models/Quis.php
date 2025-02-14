<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quis extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',

    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
