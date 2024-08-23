<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class genre extends Model
{
    use HasFactory;

    protected $table = 'genre';

    protected $guarded = [];

    public function details()
    {
        return $this->belongsToMany(Detail::class, 'genre_detail','id_genre','id_detail');
    }
}
