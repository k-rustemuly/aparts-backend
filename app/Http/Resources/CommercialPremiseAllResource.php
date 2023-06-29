<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommercialPremiseAllResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "object" => $this->object->name,
            "block" => $this->block->name,
            "floor" => $this->floor,
            "number" => $this->number,
            "area" => $this->area,
            "status" => $this->status->name,
            "ceiling_height" => $this->ceiling_height,
            "finishing_status" => $this->finishingStatus->name,
        ];
    }
}
