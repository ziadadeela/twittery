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
            'hashtags'
        ];

    protected $casts = [
        'hashtags' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
