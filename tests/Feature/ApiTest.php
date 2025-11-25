<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiTest extends TestCase
{
    public function testNotFoundIsJsonResponse(): void
    {
        $this->getJson('/api/non-existing-endpoint')
            ->assertStatus(404)
            ->assertJsonStructure([
                'message',
            ]);
    }
}
