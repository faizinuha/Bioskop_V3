<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;

    protected $table = 'studio';

    protected $fillable = ['studio'];


    public function order()
    {
        return $this->hasMany(Order::class,'id_studio','id');
    }
    public function details()
    {
        return $this->hasMany(Detail::class,'id_studio','id');
    }

    public function kursi()
    {
        return $this->belongsToMany(Kursi::class, 'studio_seat' , 'studio_id', 'kursi_id');
    }



}
