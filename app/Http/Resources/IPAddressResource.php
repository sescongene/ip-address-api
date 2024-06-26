<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IPAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ip_address' => $this->ip_address,
            'label' => $this->label,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            'history' => RevisionHistoryResource::collection($this->revisionHistory)
        ];
    }
}
