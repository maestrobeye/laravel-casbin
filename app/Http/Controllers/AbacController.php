<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbacController extends Controller
{
    public function __construct()
    {
        $this->middleware('abac'); // Apply ABACMiddleware to all methods
    }

    public function read($id)
    {
        // Authorized action for users with read permission on the specified object
        return response()->json(['message' => 'Read operation successful.']);
    }

    public function write($id)
    {
        // Authorized action for users with write permission on the specified object
        return response()->json(['message' => 'Write operation successful.']);
    }
}
