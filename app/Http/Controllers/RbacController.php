<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RbacController extends Controller
{
    public function __construct()
    {
        // $this->middleware('rbac'); // Apply CasbinMiddleware to all methods
    }

    public function index()
    {
        // Authorized action for all roles
        return response()->json(['message' => 'Welcome to the index page!']);
    }

    public function adminOnly()
    {
        // Authorized action for 'admin' role only
        return response()->json(['message' => 'This action is only for admins.']);
    }

    public function customerOnly()
    {
        // Authorized action for 'user' role only
        return response()->json(['message' => 'This action is only for customers.']);
    }
}
