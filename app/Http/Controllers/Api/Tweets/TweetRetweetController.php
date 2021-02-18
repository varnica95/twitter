<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Http\Controllers\Controller;
use App\Maps\Tweets\TweetTypeMap;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetRetweetController extends Controller
{
    public function store(Request $request, Tweet $tweet)
    {
        $request->user()->tweets()->create([
            'type' => TweetTypeMap::RETWEET,
            'original_tweet_id' => $tweet->id
        ]);
    }

    public function destroy(Request $request, Tweet $tweet)
    {
       $tweet->retweetedTweet()->where('user_id', $request->user()->id)->delete();
    }
}
