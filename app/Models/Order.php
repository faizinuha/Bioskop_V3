<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order';
    protected $guarded = [] ;

    public function detail()
    {
        return $this->belongsTo(Detail::class, 'id_detail', 'id');
    }
    // data studio
    public function studio()
    {
        return $this->belongsTo(Studio::class,'id_studios','id');
    }
    public function kursi()
    {
        return $this->belongsToMany(Kursi::class, 'order_kursi', 'id_order', 'id_kursi');
    }


}
