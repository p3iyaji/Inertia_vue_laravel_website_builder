<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WelcomeServe extends Model
{
    protected $fillable = [
        'sectn_3_title',
        
        'sectn_3_title_color', 
        'sectn_3ghover_title_color', 
        'sectn_3darkghover_title_color', 
        'sectn_3_bg_color', 
        'sectn_3_dark_bg_color', 

        'sectn_3_description',
        'sectn_3_description_color', 
        'sectn_3ghover_description_color', 
        'sectn_3dark_description_color', 
        'sectn_3darkhover_description_color', 
        'welcome_id',
        
        'sectn_3_description_color_tw',
        'sectn_3_title_color_tw',
        'sectn_3ghover_title_color_tw',
        'sectn_3darkghover_title_color_tw',
        'sectn_3ghover_description_color_tw',
        'sectn_3dark_description_color_tw',
        'sectn_3darkhover_description_color_tw',
        'sectn_3_bg_color_tw',
        'sectn_3_dark_bg_color_tw',
    ];

    public function welcome()
    {
        return $this->belongsTo(Welcome::class);
    }
}
