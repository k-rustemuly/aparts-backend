<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $replacements = [
            'surname' => $this->client->surname,
            'name' => $this->client->name,
            'patronymic' => $this->client->patronymic,
        ];
        return [
            "id" => $this->id,
            "client" => trans('client_short', $replacements),
            "iin" => $this->client->iin,
            "operation_type" => $this->operationType->name,
            "status" => $this->status->name,
            "sum" => number_format($this->sum, 2, '.', ' '),
            "created_at" => $this->created_at->translatedFormat('d F Y, H:i'),
        ];
    }
}
