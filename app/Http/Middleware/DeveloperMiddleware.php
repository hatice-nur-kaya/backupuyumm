<?php

namespace App\Http\Middleware;

use App\Core\HttpResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeveloperMiddleware
{
    use HttpResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!$request->user() || !$request->user()->hasPermission('developer')) {
            //logout
            $request->session()->invalidate();
            return $this->httpResponse(
                false,
                'You do not have permission to access this resource',
                null,
                Response::HTTP_FORBIDDEN
            );
        }

        return $next($request);
    }
}
