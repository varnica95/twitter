<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetLikeController extends Controller
{
    public function store(Request $request, Tweet $tweet)
    {
        if (($user = $request->user())->hasLiked($tweet)){
            return response(null, 409);
        }

        $user->likes()->create([
            'tweet_id' => $tweet->id
        ]);
    }

    public function destroy(Request $request, Tweet $tweet)
    {
        $request->user()
            ->likes
            ->where('tweet_id', $tweet->id)
            ->first()
            ->delete();
    }
}
