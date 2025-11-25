<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApplicationEndpointTest extends TestCase
{
    public function testApplicationsEndpointReturnsJsonOnRejection(): void
    {
        $application = [
            'applicant_name' => 'Getoar Beka',
            'country_of_origin' => 'China',
            'program_type' => 'Master',
            'application_type' => 'international',
            'submitted_documents' => [
                'passport',
                'language_certificate'
            ]
        ];

        $this->postJson('/api/applications', $application)
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'missing_documents',
            ]);
    }


    public function testApplicationsEndpointReturnsJsonOnAccept(): void
    {
        $application = [
            'applicant_name' => 'Getoar Beka',
            'country_of_origin' => 'China',
            'program_type' => 'Master',
            'application_type' => 'international',
            'submitted_documents' => [
                'passport',
                'language_certificate',
                'aps_certificate',
                'bachelor_diploma'
            ]
        ];

        $this->postJson('/api/applications', $application)
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'missing_documents',
            ])
            ->assertJsonFragment([
                'status' => 'accepted',
                'missing_documents' => []
            ]);
    }

    public function testApplicationsEndpointReturnsJsonOnFailedRequestValidation(): void
    {
        $this->postJson('/api/applications')
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'applicant_name',
                'country_of_origin',
                'program_type',
                'application_type',
                'submitted_documents'
            ]);
    }
}
