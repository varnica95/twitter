<?php

namespace App\Http\Resources\Tweets;

use App\Http\Resources\Users\UserResource;
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
        return [
            'id' => $this->id,
            'body' => $this->body,
            'type' => $this->type,
            'likes_count' => $this->likes->count(),
            'original_tweet' => new self($this->originalTweet),
            'user' => new UserResource($this->user),
            'created_at' => $this->created_at->timestamp
        ];
    }
}
