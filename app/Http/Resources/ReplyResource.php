<?php

namespace App\Http\Resources;

use App\Model\Question;
use http\QueryString;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
//            'path' => $this->path,
            'id' => $this->id,
            'question' => $this->question->title,
            'question_slug' => $this->question->slug,
            'reply' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'user' => $this->user->name,
            'user_id' => $this->user_id,
            'like_count' => $this->likes->count(),
            'user_liked' => !! $this->likes->where('user_id', $this->user_id)->count(),
        ];
    }
}
