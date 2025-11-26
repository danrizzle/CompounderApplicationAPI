<?php

namespace App\DTOs\Application;

class ApplicationDto
{
    /**
     * @param  string  $applicantName
     * @param  string  $countryOfOrigin
     * @param  string  $programType
     * @param  string  $applicationType
     * @param  array<string>  $submittedDocuments
     */
    public function __construct(
        public string $applicantName,
        public string $countryOfOrigin,
        public string $programType,
        public string $applicationType,
        public array $submittedDocuments,
    ) {}


    /**
     * @param  array<string, mixed>  $data
     * 
     * @return \App\DTOs\Application\ApplicationDto
     */
    public static function fromArray(array $data): self
    {
        $applicantName = $data['applicant_name'] ?? '';
        $countryOfOrigin = $data['country_of_origin'] ?? '';
        $programType = $data['program_type'] ?? '';
        $applicationType = $data['application_type'] ?? '';
        $submittedDocuments = $data['submitted_documents'] ?? [];

        return new self(
            applicantName: $applicantName,
            countryOfOrigin: $countryOfOrigin,
            programType: $programType,
            applicationType: $applicationType,
            submittedDocuments: array_values(array_filter($submittedDocuments, 'is_string')),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'applicant_name' => $this->applicantName,
            'country_of_origin' => $this->countryOfOrigin,
            'program_type' => $this->programType,
            'application_type' => $this->applicationType,
            'submitted_documents' => $this->submittedDocuments,
        ];
    }

    /**
     * @param  string  $document
     * 
     * @return bool
     */
    public function documentExists(string $document): bool
    {
        return in_array($document, $this->submittedDocuments, true);
    }
}
