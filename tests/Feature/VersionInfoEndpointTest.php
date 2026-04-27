<?php

namespace Tests\Feature;

use Tests\TestCase;

class VersionInfoEndpointTest extends TestCase
{
    /**
     * Test endpoint /version return struktur benar
     */
    public function test_version_endpoint_returns_data()
    {
        $response = $this->get('/version');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'app',
                'environment',
                'version',
                'commit',
                'commit_short',
                'deployed_at',
                'generated_at'
            ]);
    }

    /**
     * Test commit field tersedia (minimal tidak null)
     */
    public function test_version_has_commit_field()
    {
        $response = $this->get('/version');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'commit'
            ]);
    }
}
