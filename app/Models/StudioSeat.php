<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudioSeat extends Model
{
    use HasFactory;

    protected $table = 'studio_seat';
    protected $guarded  = [];

    public function kursi()
    {
        return $this->belongsToMany(Kursi::class, 'studio_seat', 'studio_id', 'kursi_id');
    }
}
