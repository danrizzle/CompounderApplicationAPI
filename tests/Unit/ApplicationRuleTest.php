<?php

namespace Tests\Unit;

use App\Http\Requests\StoreApplicationRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ApplicationRuleTest extends TestCase
{
    public function testStoreApplicationRequestRules()
    {
        $request = new StoreApplicationRequest;

        $validator = Validator::make([], $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('applicant_name', $validator->errors()->toArray());
        $this->assertArrayHasKey('country_of_origin', $validator->errors()->toArray());
        $this->assertArrayHasKey('program_type', $validator->errors()->toArray());
        $this->assertArrayHasKey('application_type', $validator->errors()->toArray());
        $this->assertArrayHasKey('submitted_documents', $validator->errors()->toArray());
    }

    public function testLanguageCertificateRequiredRule(): void
    {
        $application = [
            'applicant_name' => 'Getoar Beka',
            'country_of_origin' => 'China',
            'program_type' => 'Master',
            'application_type' => 'international',
            'submitted_documents' => [
                'passport',
                'bachelor_diploma',
                'aps_certificate'
            ]
        ];

        $this->postJson('/api/applications', $application)
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'missing_documents',
            ])
            ->assertJsonFragment([
                'status' => 'rejected',
                'missing_documents' => ['language_certificate']
            ]);
    }

    public function testApsCertificateRequiredRule(): void
    {
        $application = [
            'applicant_name' => 'Getoar Beka',
            'country_of_origin' => 'China',
            'program_type' => 'Master',
            'application_type' => 'international',
            'submitted_documents' => [
                'passport',
                'language_certificate',
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
                'status' => 'rejected',
                'missing_documents' => ['aps_certificate']
            ]);
    }

    public function testBachlorDiplomaRequiredRule(): void
    {
        $application = [
            'applicant_name' => 'Getoar Beka',
            'country_of_origin' => 'Germany',
            'program_type' => 'Master',
            'application_type' => 'national',
            'submitted_documents' => [
                'passport',
            ]
        ];

        $this->postJson('/api/applications', $application)
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'missing_documents',
            ])
            ->assertJsonFragment([
                'status' => 'rejected',
                'missing_documents' => ['bachelor_diploma']
            ]);
    }
}
