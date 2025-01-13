<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokoje extends Model
{
    use HasFactory;

    protected $table = "Pokoje";
    
    public function rodzaj()
    {
        return $this->belongsTo(Pokoje_rodzaj::class, 'rodzaj_id');
    }
}
