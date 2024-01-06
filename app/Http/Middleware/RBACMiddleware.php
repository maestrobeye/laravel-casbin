<?php

namespace App\Http\Middleware;

use Casbin\Enforcer;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RBACMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Check if user is authenticated
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        // Load Casbin model and policy
        $enforcer = new Enforcer('C:\Users\User\Desktop\Projet\laravel-authorization\app\Custom\rbac.model.conf', 'C:\Users\User\Desktop\Projet\laravel-authorization\app\Custom\rbac.policy.csv');
    
        // Get the current user's role
        $userRole = auth()->user()->role->nom;
    
        // Debugging statements
        Log::info('User Role: ' . $userRole);
        Log::info('Requested Path: ' . $request->path());
        Log::info('Casbin Enforce Result: ' . ($enforcer->enforce($userRole, $request->path(), $role) ? 'true' : 'false'));
        // $enforcer->loadPolicy();
        Log::info('Loaded Policies: ' . json_encode($enforcer->getPolicy(), JSON_PRETTY_PRINT));

        try {
            if ($enforcer->enforce($userRole, $request->path(), $role)) {
                return $next($request);
            }
        } catch (\Exception $e) {
            Log::error('Casbin Exception: ' . $e->getMessage());
        }
    
        // Unauthorized, return an error response
        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
