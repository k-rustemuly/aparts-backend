<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlockResource extends JsonResource
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
            "name" => $this->name,
            "cadastral_number" => $this->cadastral_number,
            "start" => $this->start ? $this->start->format('d-m-Y') : null,
            "end" => $this->end ? $this->end->format('d-m-Y') : null,
            "storeys_number" => $this->storeys_number,
            "heating" => $this->heatingType->name,
        ];
    }
}
