<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tanggal extends Model
{
    use HasFactory;

    protected $table = 'tanggal';
    protected $guarded = [];
    public function details()
    {
        return $this->hasMany(Detail::class,'id_tanggal','id');
    }
}
