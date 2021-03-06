<?php

namespace App\Models;

use App\Maps\Tweets\TweetTypeMap;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return string
     */
    public function avatar()
    {
        return 'https://gravatar.com/avatar/' . md5($this->email) . '?d=mp';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function following()
    {
        return $this->belongsToMany(
            __CLASS__,
            'followers',
            'user_id',
            'following_id'
        );
    }

    public function followers()
    {
        return $this->belongsToMany(
            __CLASS__,
            'followers',
            'following_id',
            'user_id'
        );
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function tweetsFromFollowing()
    {
        return $this->hasManyThrough(
            Tweet::class, Follower::class,
            'user_id', 'user_id',
            'id', 'following_id'
        );
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function retweets()
    {
        return $this->hasMany(Tweet::class)
            ->where('type', TweetTypeMap::RETWEET)
            ->orWhere('type', TweetTypeMap::QUOUTE);
    }

    public function hasLiked(Tweet $tweet)
    {
        return $this->likes->contains('tweet_id', $tweet->id);
    }
}
