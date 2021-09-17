<?php

namespace App\Http\Resources;

use App\Http\Resources\TestResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductResource extends ResourceCollection
{
    //protected $collect = TestResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => new TestResource($this->collection),
            'links' => [
                'currentpage' => $this->currentPage(),
                'nextpage' => $this->nextPageUrl(),
                'prevpage' => $this->previousPageUrl(),
            ]
        ];
    }
}
