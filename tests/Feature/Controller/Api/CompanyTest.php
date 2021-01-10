<?php

namespace Tests\Feature\Controller\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\TestCase;

use App\Models\Company;
use App\Models\User;
use App\Models\Client;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Feature test endpoint /api/get-companies
     *
     * @return void
     */
    public function test_get_all_companies()
    {
        $user = User::factory()->create();

        Company::factory()->count(100)->state([
            'user_id' => $user->id,
        ])->create();

        $response = $this->getAsUser('/api/get-companies', $user);
        $response->assertStatus(200);
        self::assertSame(100, $response['meta']['total']);
        self::assertArrayHasKey('name', $response['data'][0]);   
    }

    /**
     * Feature test endpoint api/get-clients/
     *
     * @return void
     */
    public function test_get_all_clients()
    {
        $user = User::factory()->create();
        $company = Company::factory()->state([
            'user_id' => $user->id,
        ])->has(Client::factory()->state([
            'user_id' => $user->id,
        ])->count(100))->create();

        $response = $this->getAsUser('api/get-clients/' . $company->id, $user);
        $response->assertStatus(200);
        self::assertSame(100, $response['meta']['total']);
        self::assertArrayHasKey('name', $response['data'][0]);
        self::assertArrayHasKey('email', $response['data'][0]);
    }
}
