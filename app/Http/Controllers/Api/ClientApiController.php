<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Client;

class ClientApiController extends Controller
{

    /**
     * Get all client companies.
     *
     * @param  Client $client
     * @return Resource
     */
    public function getClientCompanies(Client $client) {
        $this->authorize('owner', $client);
        return CompanyResource::collection($client->companies()->paginate(20));
    }
}
