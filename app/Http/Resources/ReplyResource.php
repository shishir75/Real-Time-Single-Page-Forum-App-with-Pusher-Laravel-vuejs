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
            'path' => $this->path,
            'question' => $this->question->title,
            'body' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'user' => $this->user->name,
        ];
    }
}