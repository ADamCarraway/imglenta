<?php

namespace App;

use App\Events\PhotoCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    public $guarded = ['id'];
    protected $withCount = ['likes'];

    protected static function boot()
    {
        parent::boot();

        static::deleted(function (self $photo) {
            Storage::disk('public')->delete('photos/' . $photo->path);
            $photo->likes()->delete();
        });
    }

    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLike()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }
}
