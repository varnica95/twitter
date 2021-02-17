<?php

namespace App\Http\Controllers\Api\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tweets\TweetCollection;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request): TweetCollection
    {
        $tweets = $request->user()
            ->tweetsFromFollowing()
            ->latest()
            ->with(['user', 'likes'])
            ->paginate(5);

        return new TweetCollection($tweets);
    }
}
