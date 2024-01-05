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
        Enforcer::addPermissionForUser('eve', 'articles', 'read');
        // adds a role for a user.
        Enforcer::addRoleForUser('eve', 'writer');
        // adds permissions to a rule
        Enforcer::addPolicy('writer', 'articles', 'edit');
    }

    public function giveUserRBAC(Request $request)
    {
        Enforcer::addRoleForUser($request->name, 'writer');
    }
}
