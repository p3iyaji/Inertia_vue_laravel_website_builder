<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Welcome extends Model
{
    protected $fillable =[
        'sectn_wwd',
        'sectn_wwd_bg_color',
        'sectn_ccn',
        'sectn_ccn_bg_color',
        'ccn_title',
        'ccn_title_color',
        'ccn_description',
        'ccn_description_color',
        'ccn_btn_title',
        'btn_ccn_bg_color',
        'btn_ccn_text_color',

        'sectn_3_services',
        // other parts in welcome serve relationship

        
        'sectn_oservices',
        'sectn_oserv_bg_color',
        'sectn_oservdark_bg_color',
        // other parts in our services relationship
       

        'sectn_services',
        'sectn_serv_title',
        'sectn_serv_description',
        'services_image',
        'sectn_serv_bg_color',
        'sectn_serv_title_color',
        'sectn_serv_description_color',

        'sectn_client_logo',
        'sectn_client_title',
        'sectn_client_text_color',
        'sectn_client_bg_color',
        'sectn_dclient_text_color',
        'sectn_dclient_bg_color',
        
        // Tailwind classes
        'sectn_wwd_bg_color_tw',
        'sect_ccn_bg_color_tw',
        'ccn_title_color_tw',
        'ccn_description_color_tw',
        'btn_ccn_bg_color_tw',
        'btn_ccn_text_color_tw',



        'sectn_oserv_bg_color_tw',
        'sectn_oservdark_bg_color_tw',

        'sectn_serv_bg_color_tw',
        'sectn_serv_title_color_tw',
        'sectn_serv_description_color_tw',
        'sectn_client_text_color_tw',
        'sectn_client_bg_color_tw',
        'sectn_dclient_text_color_tw',
        'sectn_dclient_bg_color_tw',

    ];

    public function welcomeserves()
    {
        return $this->hasMany(WelcomeServe::class);
    }

    public function welcomeourserves()
    {
        return $this->hasMany(WelcomeOurServe::class);
    }

    public function companylogos() 
    {
        $this->hasMany(CompanyLogo::class);
    }
}
