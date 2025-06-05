<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyLogo extends Model
{
    protected $fillable = [
      'name',
      'logos',
      'welcome_id',       
    ];

    public function welcome ()
    {
      $this->belongsTo(Welcome::class);
    }
}
