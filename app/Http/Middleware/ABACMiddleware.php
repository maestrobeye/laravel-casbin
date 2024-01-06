<?php

namespace App\Http\Middleware;

use Casbin\Enforcer;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ABACMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Load Casbin model and policy
        $enforcer = new Enforcer('vendor\casbin\casbin\examples\abac_model.conf', 'vendor\casbin\casbin\examples\abac_policy.csv');

        // Get the current user's attributes or any relevant information
        $userAttributes = [
            'user' => auth()->user()->name, // Adjust based on your user model
        ];

        // Get the requested object and action
        $object = 'data|object|' . $request->route('id'); // Adjust based on your application
        $action = $request->getMethod(); // Assuming action is based on HTTP method

        // Check if the user has permission
        if (!$enforcer->enforce(array_merge($userAttributes, compact('object', 'action')))) {
            // Unauthorized, redirect or return an error response
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Proceed with the request
        return $next($request);
    }
}
