<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::create([
            'name' => 'owner',
        ]);

        $buyer = Role::create([
            'name' => 'buyer',
        ]);

        $user = User::create([
            'name' => 'Dian Erdiana',
            'email' => 'dian@owner.com',
            'password' => '123456'
        ]);

        $user->assignRole($ownerRole);
    }
}
