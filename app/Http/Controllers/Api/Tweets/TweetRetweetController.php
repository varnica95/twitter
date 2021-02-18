<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetDeletedEvent;
use App\Events\Tweets\TweetLikeUpdatedEvent;
use App\Events\Tweets\TweetRetweetsUpdated;
use App\Events\Tweets\TweetRetweetsUpdatedEvent;
use App\Events\Tweets\TweetStoredEvent;
use App\Http\Controllers\Controller;
use App\Maps\Tweets\TweetTypeMap;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetRetweetController extends Controller
{
    public function store(Request $request, Tweet $tweet)
    {
        $retweet = $request->user()->tweets()->create([
            'type' => TweetTypeMap::RETWEET,
            'original_tweet_id' => $tweet->id
        ]);

        broadcast(new TweetStoredEvent($retweet));
        broadcast(new TweetRetweetsUpdatedEvent($request->user(), $tweet));
    }

    public function destroy(Request $request, Tweet $tweet)
    {
        broadcast(new TweetDeletedEvent($tweet->retweetedTweet));

        $tweet->retweetedTweet()->where('user_id', $request->user()->id)->delete();

        broadcast(new TweetRetweetsUpdatedEvent($request->user(), $tweet));
    }
}
