<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $guarded = ['id'];

    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
