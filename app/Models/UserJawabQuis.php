<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserJawabQuis extends Model
{
    use HasFactory;

    protected $table = 'userjawabquis';

    protected $guarded = [
        'id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
