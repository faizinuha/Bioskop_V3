<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'detail';
    protected $guarded = [];

    public function genres()
    {
        return $this->belongsToMany(genre::class, 'genre_detail', 'id_detail', 'id_genre');
    }

    public function time()
    {
        return $this->belongsTo(time::class, 'id_time', 'id');
    }

    public function tanggal()
    {
        return $this->belongsTo(tanggal::class, 'id_tanggal', 'id');
    }


    public function orders()
    {
        return $this->hasMany(Order::class, 'id_detail', 'id');
    }
    public function studio()
    {
        return $this->belongsTo(Studio::class, 'id_studio', 'id');
    }




    public function scopeFilter($query, array $filters)
    {
            $query->when($filters['search'] ?? false, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('judul', 'like', '%' . $search . '%')
                        ->orWhere('penulis', 'like', '%' . $search . '%')
                        ->orWhere('pemeran', 'like', '%' . $search . '%')
                        ->orWhereHas('genres', function ($query) use ($search) {
                            $query->Where('genre', 'like', '%' . $search . '%');
                        });
                });
            });



    }
}
