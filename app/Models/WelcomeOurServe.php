<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WelcomeOurServe extends Model
{
    protected $table = 'welcome_our_servs';

    protected $fillable =[
        'sectn_oserv_title',
        'sectn_oservh_bg_color',
        'sectn_oservhd_bg_color',

        'sectn_oserv_title_color',
        'sectn_oservdark_title_color',
        'sectn_oservhover_title_color',
        'sectn_oservdarkhover_title_color',

        'sectn_oserv_description',
        'sectn_oserv_description_color',
        'sectn_oservh_description_color',
        'sectn_oservd_description_color',
        'sectn_oservdh_description_color',

        'sectn_oservh_bg_color_tw',
        'sectn_oservhd_bg_color_tw',
        'sectn_oserv_title_color_tw',
        'sectn_oservdark_title_color_tw',
        'sectn_oservhover_title_color_tw',
        'sectn_oservdarkhover_title_color_tw',
        'sectn_oserv_description_color_tw',
        'sectn_oservh_description_color_tw',
        'sectn_oservd_description_color_tw',
        'sectn_oservdh_description_color_tw',
        'welcome_id',

    ];

    public function welcome()
    {
        return $this->belongsTo(Welcome::class);
    }
}
