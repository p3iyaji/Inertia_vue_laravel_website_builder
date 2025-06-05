<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'sectn_header',
            'sectn_header_title',
            'sectn_header_title_color',
            'sectn_header_description',
            'sectn_header_description_color',
            'sectn_header_bg_color',

            'sectn_mivi',
            'sectn_mivi_title',
            'sectn_mivi_title_color',
            'sectn_mivi_description',
            'sectn_mivi_description_color',

            'sectn_slogan',
            'sectn_slogan_caption',
            'sectn_slogan_subcaption',
            'slogan_image',
            'sectn_slogan_caption_color',
            'sectn_slogan_bg_color',
            'sectn_slogan_subcaption_color',

            'sectn_team',
            'team_title',
            'team_caption',
            'team_title_color',
            'team_caption_color',
            'team_bg_color',
            'sectn_team_mem',
            'sectn_header_title_color_tw',
            'sectn_header_description_color_tw',
            'sectn_header_bg_color_tw',
            'sectn_mivi_title_color_tw',
            'sectn_mivi_description_color_tw',
            'sectn_slogan_caption_color_tw',
            'sectn_slogan_bg_color_tw',
            'sectn_slogan_subcaption_color_tw',
            'team_title_color_tw',
            'team_caption_color_tw',
            'team_bg_color_tw',
    ];

    public function teammembers()
    {
        $this->hasMany(TeamMember::class);
    }
}
