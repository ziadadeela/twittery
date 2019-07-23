<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;
use Thujohn\Twitter\Facades\Twitter;


Auth::routes();


Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

//Route::get('test', function () {
//    $usersIds = User::query()->pluck('provider_id', 'id');
//    $usersLastTweet = \App\Tweet::query()
//        ->select('tweets.user_id', 'tweets.twitter_id')
//        ->leftJoin('tweets as TT', function ($q) {
//            $q->on('tweets.user_id', '=', 'TT.user_id')
//                ->on('tweets.twitter_created_at', '<', 'TT.twitter_created_at');
//        })
//        ->whereNull('TT.twitter_created_at')
//        ->pluck('twitter_id', 'user_id')
//        ->toArray();
//    foreach ($usersIds as $userId => $userTwitterId) {
//        $params = ['user_id' => $userTwitterId, 'format' => 'array'];
//        if (isset($usersLastTweet[$userId])) {
//            $params['since_id'] = $usersLastTweet[$userId];
//        }
//        $userTweets = Twitter::getUserTimeline($params);
////        $tweetsToSync =[];
////        dd($userTweets);
//        dump($userTweets);
//        foreach ($userTweets as $userTweet) {
////            dd(new DateTime($userTweet->created_at));
//
//            $recordDetails = [
//                'twitter_id' => $userTweet['id'],
//                'text' => $userTweet['text'],
//                'retweet_count' => $userTweet['retweet_count'],
//                'favorite_count' => $userTweet['favorite_count'],
//                'user_id' => $userId,
//                'twitter_created_at' => (new DateTime($userTweet['created_at'])),
//                'hashtags' => $userTweet['entities']['hashtags'] ?? []
//            ];
//            \App\Tweet::query()->create($recordDetails);
//        }
//    }
////    dd($response = Twitter::getUserTimeline(['user_id' => '996399570627244033']));
//});


Route::group([
    'middleware' => [
        'web',
        'auth'
    ]

], function () {
    Route::resource('user', 'UserController');
    Route::resource('tweet', 'TweetController');
    Route::resource('hashtag', 'HashtagController');
    Route::get('/', 'HomeController@welcome')->name('welcome');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('hashtag/{hashtag}/tweets', 'HashtagController@getHashtagTweets')->name('hashtag.tweets');


});
