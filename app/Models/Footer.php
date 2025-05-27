<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $fillable = [
        'bg_color',
        'text_color',
        'year',
        'company_name',
        'dark_bg_color',
        'dark_text_color',
        'bg_color_tw',
        'text_color_tw',
        'dark_bg_color_tw',
        'dark_text_color_tw',

    ];

    
}
