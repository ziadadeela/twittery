<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable =
        [
            'id',
            'twitter_id',
            'text',
            'user_id',
            'retweet_count',
            'favorite_count',
            'twitter_created_at',
        ];

    protected $casts = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class);
    }

}
