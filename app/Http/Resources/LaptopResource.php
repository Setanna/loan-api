<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaptopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'laptop' => [
                'id' => $this->id,
                'manifacturer' => $this->manifacturer,
                'model' => $this->model,
                'mouse_id' => $this->mouse_id
            ]
        ];
    }
}
