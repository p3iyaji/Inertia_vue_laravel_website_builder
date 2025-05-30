<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    protected $fillable = [
        'get_in_touch',
        'company_logo',
        'company_name',
        'bg_color',
        'text_color',
        'dark_bg_color',
        'dark_text_color',
        'bg_color_tw',
        'text_color_tw',
        'dark_bg_color_tw',
        'dark_text_color_tw',

    ];
}
