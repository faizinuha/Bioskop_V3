<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    // Tambahkan ini jika nama tabel tidak sesuai konvensi jamak
    protected $table = 'films';

    protected $fillable = ['judul', 'deskripsi', 'gambar'];
}
