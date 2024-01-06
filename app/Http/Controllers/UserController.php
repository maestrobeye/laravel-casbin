<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Lauthz\Facades\Enforcer;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function givePermissionToUser(Request $request)
    {
        // adds permissions to a user
        Enforcer::addPermissionForUser('Mr. Scotty Lockman', 'articles', 'read');
        // adds a role for a user.
        Enforcer::addRoleForUser('Mr. Scotty Lockman', 'admin');
        // adds permissions to a rule
        Enforcer::addPolicy('admin', 'articles', 'edit');
    }

    public function giveUserRBAC(Request $request)
    {
        Enforcer::addRoleForUser('Mr. Scotty Lockman', 'admin');
    }
}
