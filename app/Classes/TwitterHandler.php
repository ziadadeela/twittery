<?php

namespace App\Classes;


use App\Contracts\TweetFormatterContract;
use App\Hashtag;
use App\User;
use Thujohn\Twitter\Facades\Twitter;

class TwitterHandler
{

    private function getUsersLastTweet()
    {
        $usersLastTweet = \App\Tweet::query()
            ->select('tweets.user_id', 'tweets.twitter_id')
            ->leftJoin('tweets as TT', function ($q) {
                $q->on('tweets.user_id', '=', 'TT.user_id')
                    ->on('tweets.twitter_created_at', '<', 'TT.twitter_created_at');
            })
            ->whereNull('TT.twitter_created_at')
            ->pluck('twitter_id', 'user_id')
            ->toArray();

        return $usersLastTweet;
    }


    public function syncTweets()
    {
        $usersLastTweet = $this->getUsersLastTweet();
        $users = User::all();

        foreach ($users as $user) {
            $params = ['user_id' => $user->provider_id, 'format' => 'array'];
            if (isset($usersLastTweet[$user->id])) {
                $params['since_id'] = $usersLastTweet[$user->id];
            }
            $userTweets = Twitter::getUserTimeline($params);
            $this->syncUserTweets($user, $userTweets);
        }
    }

    private function syncUserTweets(User $user, array $userTweets)
    {
        foreach ($userTweets as $userTweet) {
            $formatter = app(TweetFormatterContract::class, ['tweet' => $userTweet]);
            $tweet = $user->tweets()->create($formatter->format());
            $this->syncTweetHashTags($tweet, $formatter->getHashTags());
        }
    }

    private function syncTweetHashTags($tweet, array $hashtags)
    {
        $tweetHashtagsIds = [];
        foreach ($hashtags as $hashtag) {
            $newHT = Hashtag::firstOrCreate(['text' => $hashtag]);
            $tweetHashtagsIds[] = $newHT->id;
        }
        $tweet->hashtags()->sync($tweetHashtagsIds);
    }

}