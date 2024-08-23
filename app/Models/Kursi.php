<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kursi extends Model
{
    use HasFactory;
    protected $table = 'kursi';
    protected $fillable = ['id_studio', 'kursi'];


    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_kursi', 'id_order','id_kursi');
    }

public function studios()
{

}
    public function studio()
    {
        return $this->belongsToMany(Studio::class, 'studio_seat' , 'studio_id', 'kursi_id');
    }
    public function isReservedInStudio($studioId)
    {
        // Logika untuk mengecek apakah kursi sudah dipesan di studio tertentu
        return $this->orders()->where('studio_id', $studioId)->exists();
    }

}
