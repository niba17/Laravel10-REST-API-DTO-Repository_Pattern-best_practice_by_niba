<?php

namespace App\Http\Resources;

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
            'uuid' => $this->uuid,
            'identifier' => $this->identifier,
            'password' => $this->password,
            'slug' => $this->slug,
            'email_verified_at' => $this->email_verified_at,
            'remember_token' => $this->remember_token,
            'created_at' => $this->created_at ? $this->created_at->format('d M Y H:i') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('d M Y H:i') : null,
            'dfh_created_at' => $this->created_at ? $this->created_at->diffForHumans() : null,
            'dfh_updated_at' => $this->updated_at ? $this->updated_at->diffForHumans() : null
        ];
    }
}
// 2024-02-04 13:20:54
