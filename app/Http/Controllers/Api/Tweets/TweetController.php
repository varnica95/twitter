<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetStoredEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tweets\TweetStoreRequest;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('store');
    }

    public function store(TweetStoreRequest $request)
    {
        $tweet = $request->user()->tweets()->create($request->only('body'));

        broadcast(new TweetStoredEvent($tweet));
    }
}
