<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationValidationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $status = $this->resource['status'] ?? 'rejected';
        $missingDocuments = $this->resource['missing_documents'] ?? [];

        return [
            'status' => $status,
            'missing_documents' => $missingDocuments,
        ];
    }
}
