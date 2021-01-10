<?php

namespace Tests\Feature\Controller\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\TestCase;

use App\Models\Company;
use App\Models\User;
use App\Models\Client;

class ClientTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Feature test endpoint api/get-client-companies/
     *
     * @return void
     */
    public function test_client_companies()
    {
        $user = User::factory()->create();
        $client = Client::factory()->state([
            'user_id' => $user->id,
        ])->has(Company::factory()->state([
            'user_id' => $user->id,
        ])->count(100))->create();

        $response = $this->getAsUser('api/get-client-companies/' . $client->id, $user);
        $response->assertStatus(200);
        self::assertSame(100, $response['meta']['total']);
        self::assertArrayHasKey('name', $response['data'][0]);
    }
}
