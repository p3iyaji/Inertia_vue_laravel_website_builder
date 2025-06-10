<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SomeServ extends Model
{
    protected $fillable = [
            'sectn_someserv_title',
            'sectn_someserv_title_color',

            'sectn_someserv_description',
            'sectn_someserv_des_color',

            'sectn_someserv_bg_color', 
            'sectn_someserv_dark_bg_color', 

            'someservimage',

            'sectn_someserv_bg_color_tw',
            'sectn_someserv_title_color_tw',
            'sectn_someserv_des_color_tw',
            'sectn_someserv_dark_bg_color_tw', 

            'service_id',
    ];

    public function service()
    {
        $this->belongsTo(Service::class);
    }
}
