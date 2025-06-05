<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SomeServ extends Model
{
    protected $fillable = [
            'sectn_someserv_title',
            'sectn_someserv_description',
             'someservimage',
            'sectn_someserv_title_bg_color',
            'sectn_someserv_des_bg_color', 
            'sectn_someserv_title_bg_color_tw',
            'sectn_someserv_des_bg_color_tw',
            'services_id',
    ];

    public function service()
    {
        $this->belongsTo(Service::class);
    }
}
