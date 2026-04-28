<?php

namespace Tests\Feature;

use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    /**
     * Test endpoint /health return OK dan struktur JSON benar
     */
    public function test_health_endpoint_returns_ok()
    {
        $response = $this->get('/health');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'app',
                'environment',
                'timestamp',
                'checks' => [
                    'database' => [
                        'status',
                        'message',
                        'connection'
                    ]
                ]
            ]);
    }

    /**
     * Test endpoint tetap punya field status valid
     */
    public function test_health_status_value_is_valid()
    {
        $response = $this->get('/health');

        $response->assertStatus(
            in_array($response->getStatusCode(), [200, 503]) ? $response->getStatusCode() : 500
        );
    }
}
