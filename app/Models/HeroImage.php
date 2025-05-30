<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroImage extends Model
{
    protected $fillable = [
        'hero_id', 'image'
    ];
    public function Hero()
    {
        return $this->belongsTo(Hero::class);
    }
}
