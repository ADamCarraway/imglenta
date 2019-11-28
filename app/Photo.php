<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public $guarded = ['id'];

    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }
}
