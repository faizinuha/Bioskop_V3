<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $table = 'time';

    protected $guarded = [] ;

    public function details()
    {
        return $this->hasMany(Detail::class, 'id_time','id');
    }
}
