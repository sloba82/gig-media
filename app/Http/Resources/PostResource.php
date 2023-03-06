<?php

namespace App\Http\Resources;

// use Illuminate\Http\Request;
// use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostResource extends ResourceCollection
{

    private $pagination;

    public function __construct($resource)
    {
        $this->pagination = $resource->total();
        $resource = $resource->getCollection();

        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public static $wrap = 'result';

    public function toArray($request): array
    {
        return $this->collection->toArray();
    }

    public function with($request)
    {
        return [
            'count' =>  $this->pagination
        ];
    }
}
