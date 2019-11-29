<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function feeds()
    {
        return $this->hasMany(Feed::class);
    }

    public function like(Photo $photo)
    {
        $data = ['user_id' => $this->id, 'photo_id' => $photo->id];

        if(!Like::where($data)->exists()){
            Like::query()->create($data);
        }
    }

    public function unlike(Photo $photo)
    {
        $photo->likes()->where('user_id', $this->id)->delete();
    }

    public function subscribe(Feed $feed)
    {
        $data = [
            'user_id' => $this->id,
            'feed_id' => $feed->id
        ];

        if(!Subscriber::where($data)->exists()){
            Subscriber::query()->create($data);
        }
    }

    public function unsubscribe(Feed $feed)
    {
        $feed->subscribers()->where('user_id', $this->id)->delete();
    }
}
