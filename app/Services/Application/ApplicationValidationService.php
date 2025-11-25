<?php

namespace App\Services\Application;

use App\Actions\Application\ValidateDocumentsAction;
use App\DTOs\Application\ApplicationDto;

class ApplicationValidationService
{
    /**
     * @param  \App\Actions\Application\ValidateDocumentsAction  $validateDocumentsAction
     */
    public function __construct(
        private ValidateDocumentsAction $validateDocumentsAction
    ) {}

    /**
     * @param  \App\DTOs\Application\ApplicationDto  $data
     * 
     * @return array<string, mixed>
     */
    public function validate(ApplicationDto $data): array
    {
        $documentsValidated = $this->validateDocumentsAction->execute($data);

        return [
            'status' => empty($documentsValidated) ? 'accepted' : 'rejected',
            'missing_documents' => $documentsValidated,
        ];
    }
}
