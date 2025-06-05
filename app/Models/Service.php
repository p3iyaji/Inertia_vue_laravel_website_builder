<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable =[
        'sectn_services',
            'sectn_services_title',
            'sectn_services_title_color', 
            'sectn_header_bg_color',
            'sectn_someserv',
            'sectn_servslogan',
            'sloganimage',
            'caption_title',
            'slogan',
            'slogan_bg_color', 
            'caption_color', 
            'slogan_color',

            'sectn_someserv_bg_color',
            'sectn_someserv_title_bg_color',
            'sectn_someserv_des_bg_color',

            'sectn_allserve',
            'allserve_bg_color',

            'sectn_services_title_color_tw',
            'sectn_header_bg_color_tw',
            'sectn_someserv_bg_color_tw',
            'slogan_bg_color_tw',
            'caption_color_tw',
            'slogan_color_tw',
    ];

    public function someservs()
    {
        $this->hasMany(SomeServ::class);
    }

    public function allserves()
    {
        $this->hasMany(AllServe::class);
    }
}
