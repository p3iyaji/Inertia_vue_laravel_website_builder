<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'team_mem_name',
        'team_mem_position',
        'team_mem_description',
        'team_mem_image',
        'team_mem_name_color',
        'team_mem_position_color',
        'team_mem_description_color',
        'team_mem_bg_color',

        'team_mem_name_color_tw',
        'team_mem_position_color_tw',
        'team_mem_description_color_tw',    
        'team_mem_bg_color_tw',
        'about_id',
    ];

    public function about()
    {
        $this->belongsTo(About::class);
    }
}
