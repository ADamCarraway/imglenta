<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    public $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function subscribers()
    {
        return $this->hasMany(Subscriber::class);
    }
}
