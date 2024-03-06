<?php

namespace App\Http\Middleware;

use App\Core\HttpResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    use HttpResponse;
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!$request->user() || !$request->user()->hasPermission($permission)) {
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
