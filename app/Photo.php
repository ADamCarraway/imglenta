<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    public $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::deleted(function (self $photo){
            Storage::disk('public')->delete('photos/'.$photo->path);
        });
    }

    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }
}
