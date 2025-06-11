<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'src',
            'main_section',
            'office_block_bg_color',
            'office_title',
            'office_title_color',
            'address',
            'address_color',
            'email',
            'email_color',
            'phone',
            'phone_color',
            
            'office_block_bg_color_tw',
            'office_title_color_tw',
            'email_color_tw',
            'phone_color_tw',
            'address_color_tw',
    ];
}
