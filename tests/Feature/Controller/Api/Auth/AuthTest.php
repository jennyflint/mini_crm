<?php

namespace Tests\Feature\Controller\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{

    use RefreshDatabase;
    /**
     * Feature test endpoint api/login.
     *
     * @return void
     */
    public function test_login()
    {
        $user = User::factory()->create();

        $response = $this->post('api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertStatus(200);
       
        self::assertArrayHasKey('token', $response);
        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);

        $response = $this->post('api/login', [
            'email' => $user->email,
            'password' => 'password1',
        ])->assertStatus(403);
    }
}
