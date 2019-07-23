<?php

namespace App\Http\Resources;

use App\Facades\TweetsHelperFacade;
use App\Tweet;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Tweet $this */
        return [
            'id'=>$this->id,
            'text'=>$this->text,
            'user_id'=>$this->user->name,
            'retweet_count'=>$this->retweet_count,
            'favorite_count'=>$this->favorite_count,
            'twitter_created_at'=>$this->twitter_created_at,
            'hashtags'=>TweetsHelperFacade::formatHashTags($this->hashtags),



        ];
    }
}
