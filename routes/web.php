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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

Route::get('test', function () {
    $usersIds = User::query()->pluck('provider_id','id');
    foreach ($usersIds as $userId=>$userTwitterId){
        $userTweets = Twitter::getUserTimeline(['user_id'=>$userTwitterId,'format'=>'array']);
//        $tweetsToSync =[];
//        dd($userTweets);
        foreach ($userTweets as $userTweet){
//            dd(new DateTime($userTweet->created_at));

            $recordDetails = [
              'twitter_id'=>$userTweet['id'],
                'text'=>$userTweet['text'],
                'retweet_count'=>$userTweet['retweet_count'],
                'favorite_count'=>$userTweet['favorite_count'],
                'user_id'=>$userId,
                'twitter_created_at'=>(new DateTime($userTweet['created_at'])),
                'hashtags'=>$userTweet['entities']['hashtags']??[]
            ];
            \App\Tweet::query()->create($recordDetails);
        }
    }
    dd($response = Twitter::getUserTimeline(['user_id'=>'996399570627244033'])
    );
});

Route::resource('user', 'UserController');
Route::resource('tweet', 'TweetController');