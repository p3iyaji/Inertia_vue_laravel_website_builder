<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable =[
        'sectn_services',
            'sectn_services_title',
            'sectn_services_title_color', 
            'sectn_header_bg_color',

            'sectn_someserv',
            'sectn_someserve_bg_color',
            'sectn_someserve_dark_bg_color',
            
            'sectn_servslogan',
            'sloganimage',

            'caption_title',
            'caption_color', 

            'slogan',
            'slogan_color',

            'slogan_bg_color', 

            'sectn_allserve',
            'allserve_bg_color',

            'sectn_services_title_color_tw',
            'sectn_header_bg_color_tw',
            'sectn_someserve_bg_color_tw',
            'sectn_someserve_dark_bg_color_tw',
            'slogan_bg_color_tw',
            'caption_color_tw',
            'slogan_color_tw',
            'allserve_bg_color_tw',
    ];

    public function someservs()
    {
        return $this->hasMany(SomeServ::class); 
    }
    
    public function allserves()
    {
        return $this->hasMany(AllServe::class); 
    }
}
