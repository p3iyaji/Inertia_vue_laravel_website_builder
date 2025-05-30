<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = [
        'caption',
        'sub_caption',
        'contact_title',
        'contact_link',
        'learn_title',
        'learn_link',
    ];

    public function images()
    {
        return $this->hasMany(HeroImage::class);
    }
}
