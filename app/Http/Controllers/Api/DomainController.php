<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Services\DomainAccessManager;
use Illuminate\Http\JsonResponse;
use App\Request;

class DomainController extends Controller
{
    private DomainAccessManager $accessManager;

    public function __construct(DomainAccessManager $accessManager)
    {
        $this->authorizeResource(Domain::class);
        $this->accessManager = $accessManager;
    }

    public function update(Request $request, Domain $domain): JsonResponse
    {
        if (!$this->accessManager->checkAccess($request, $domain)) {
            return response()->json(['error' => 'Access Denied'], 403);
        }

        $domain->update([
            'name' => $request->post('name'),
        ]);

        return response()->json($domain);
    }
}
