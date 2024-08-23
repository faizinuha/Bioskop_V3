<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderKursi extends Model
{
    use HasFactory;

    protected $table = 'order_kursi';
    protected $guarded = [];

    public function studios()
    {
        return $this->belongsTo(Studio::class, 'id_studio');
    }

    public function detail()
    {
        return $this->belongsTo(Detail::class, 'id_detail');
    }
    public function kursi()
    {
        return $this->belongsToMany(Kursi::class, 'order_kursi', 'order_id', 'kursi_id');
    }
}
