<?php

namespace App\Classes;


use DateTime;
use Illuminate\Support\Arr;

class TweetFormatter
{
    protected $tweet;

    public function __construct($tweet)
    {
        $this->tweet = $tweet;
    }

    /**
     * @return mixed
     */
    public function getTweet()
    {
        return $this->tweet;
    }

    /**
     * @param mixed $tweet
     */
    public function setTweet($tweet)
    {
        $this->tweet = $tweet;
    }

    public function format()
    {
        $tweet = $this->tweet;

        return [
            'twitter_id' => $tweet['id'],
            'text' => $tweet['text'],
            'retweet_count' => $tweet['retweet_count'],
            'favorite_count' => $tweet['favorite_count'],
            'twitter_created_at' => $this->formatDate($tweet['created_at']),
            'hashtags' => $this->getHashTags()
        ];
    }

    public function getHashTags()
    {
        return Arr::pluck($this->tweet['entities']['hashtags'] ?? [], 'text');
    }

    private function formatDate($date)
    {
        return new DateTime($date);
    }

}