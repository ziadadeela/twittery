<?php


namespace App\Classes;


use Illuminate\Support\Collection;

class TweetsHelper
{
    /**
     * @param Collection $hashTags
     * @return mixed
     */

    //TODO: modify css shit in table
    public function formatHashTags($hashTags)
    {
        return $hashTags->map(function ($hashTag) {
            return generate_link_badge($hashTag->text, route('hashtag.tweets', ['hashtag' => $hashTag]));
        })->implode('');
    }

}