<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetStoredEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tweets\TweetStoreRequest;
use App\Maps\Tweets\TweetTypeMap;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('store');
    }

    public function store(TweetStoreRequest $request)
    {
        $tweet = $request->user()->tweets()->create([
            'body' => $request->body,
            'type' => TweetTypeMap::TWEET
        ]);

        broadcast(new TweetStoredEvent($tweet));
    }
}
