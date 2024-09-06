<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\categories;
class product extends Model
{
    use HasFactory;
    public function categories() {

        return $this->BelongsTo(categories::class);
    }
}
