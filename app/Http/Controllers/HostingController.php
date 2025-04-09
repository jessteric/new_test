<?php

namespace App\Http\Controllers;

use App\HostingRouter;
use App\Request;
use App\Services\DomainAccessManager;
use Illuminate\Http\Response;

class HostingController extends Controller
{
    public function fallback(Request $request, HostingRouter $router): Response
    {
        return $router->handle($request);
    }

    public function handle(Request $request): Response
    {
        $domain = $request->domain();

        if ($domain && !app(DomainAccessManager::class)->checkAccess($request, $domain)) {
            return new Response('Access denied', 403);
        }

        $content = $domain?->name ?? 'no content';
        return new Response($content);
    }
}
