<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllServe extends Model
{
    protected $fillable = [
        'allserve_title',
        'allserve_description',
        'allserve_image',
        'allserve_title_color',
        'allserve_description_color',
        'allserve_title_color_tw',
        'allserve_description_color_tw',
        'service_id',

    ];

    public function service()
    {
        $this->belongsTo(Service::class);
    }
}
