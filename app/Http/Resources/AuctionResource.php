<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuctionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "name" => $this->name,
            "description" => $this->description,
            "catogray_id" => $this->catogray_id,
            "initial_price" => $this->initial_price,
            "type" => $this->type,
            "start_date" => $this->start_date,
            "end_data" => $this->end_data,
            "images" => $this->images
        ];
    }
}
