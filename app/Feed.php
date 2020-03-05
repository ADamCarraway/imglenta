<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Feed extends Model
{
    public $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::deleted(function (self $feed){
            $feed->photos()->delete();
            $feed->subscribers()->delete();
        });
    }

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

    public function isSubscriber()
    {
        return $this->subscribers()->where('user_id', auth()->id())->exists();
    }
}
