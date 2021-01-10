<?php
namespace Tests\Feature;
use Tests\TestCase as BaseTestCase;
use App\Models\User;
use Illuminate\Testing\TestResponse;
class TestCase extends BaseTestCase {
    
    private function jsonAsUser(?User $user, string $method, $uri, array $data = [], array $headers = []): TestResponse
    {
        $user = $user ?: User::factory()->create();
        $headers['X-Requested-With'] = 'XMLHttpRequest';
        $headers['Authorization'] = 'Bearer '.$user->createToken('api_token')->plainTextToken;

        return parent::json($method, $uri, $data, $headers);
    }

    protected function getAsUser(string $url, ?User $user = null): TestResponse
    {
        return $this->jsonAsUser($user, 'get', $url);
    }
} 