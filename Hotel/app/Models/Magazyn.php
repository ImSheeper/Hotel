<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazyn extends Model
{
    use HasFactory;

    protected $table = 'magazyn';

    public function produkt() {
        return $this->belongsTo(Produkt::class, 'id');
    }
}
