<?php

namespace App\Http\Resources;

use Buildit\Helpers\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            "iin" => $this->iin,
            "phone_number" => PhoneNumber::unformat($this->phone_number),
            "surname" => $this->surname,
            "name" => $this->name,
            "patronymic" => $this->patronymic,
        ];
    }
}
