<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'loan' => [
                'id' => $this->id,
                'user_id' => $this->student_id,
                'laptop_id' => $this->laptop_id,
                'loan_date' => $this->loan_date,
                'loan_expiration_date' => $this->loan_expiration_date
            ]
        ];
    }
}
