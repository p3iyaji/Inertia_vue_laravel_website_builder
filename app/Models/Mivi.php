<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mivi extends Model
{
    protected $fillable = [
        'mission_title',
        'mission_title_color',
        'mission_title_color_tw',
        'mission_description',
        'mission_description_color',
        'mission_description_color_tw',
        'vision_title',
        'vision_title_color',
        'vision_title_color_tw',
        'vision_description',
        'vision_description_color',
        'vision_description_color_tw',
        'about_id'
    ];

    public function about()
    {
        return $this->belongsTo(About::class);
    }
}
