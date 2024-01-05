<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'writer', 'customer'];

        foreach ($roles as $value) {
            $role = new Role();
            $role->nom = $value;

            $role->save();
        }
    }
}
