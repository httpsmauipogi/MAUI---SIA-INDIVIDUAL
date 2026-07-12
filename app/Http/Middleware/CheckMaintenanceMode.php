<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        if (site_setting('maintenance_mode', false)) {
            return response()->view('frontend.maintenance', [], 503);
        }

        return $next($request);
    }
}
