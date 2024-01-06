<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_role = Role::where('nom','admin')->first();

        $admin = new User();
        $admin->name = 'soce';
		$admin->email = 'admin@admin.sn';
		$admin->password = Hash::make('Passer123');
		$admin->role_id = $admin_role->id;
		$admin->save();
    }
}
