<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ObjectResource extends JsonResource
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
            "name_kk" => $this->name_kk,
            "name_ru" => $this->name_ru,
            "description" => $this->description,
            "city" => $this->city->name,
            "status" => $this->status->name,
            "class" => $this->class->name,
        ];
    }
}
