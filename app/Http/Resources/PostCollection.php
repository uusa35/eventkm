<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($element) {
                return [
                    'id' => $element->id,
                    'thumb' => $element->getCurrentImageAttribute(),
                    'large' => $element->getCurrentImageAttribute('image', 'large'),
                    'title' => $element->title,
                    'slug' => $element-> slug,
                    'keywords' => $element->keywords,
                    'video_url' => $element->video_url,
                    'created_at' => $element->created_at->diffForHumans(),
                    'user' => UserExtraLightResource::make($element->resource->user),
                    'comments' => CommentExtraLightResource::collection($element->resource->comments),
                ];
            }),
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage()
            ];
    }
    public function withResponse($request, $response)
    {
        $jsonResponse = json_decode($response->getContent(), true);
        unset($jsonResponse['links'],$jsonResponse['meta']);
        $response->setContent(json_encode($jsonResponse));
    }
}
