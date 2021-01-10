<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyApiController extends Controller
{
    /**
     * Get all user campaines
     *
     * @return Resource
     */
    public function getAllCompanies()
    {
        return CompanyResource::collection(Auth::user()->companies()->paginate(20));
    }

    /**
     * Get all company clients.
     *
     * @param  Company $company
     * @return Resource
     */
    public function getAllClients(Company $company)
    {
        $this->authorize('owner', $company);
        return ClientResource::collection($company->clients()->paginate(20));
    }
}
