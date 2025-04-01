<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateUserUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'user']);

        $user = User::create([
            'name' => 'Mark Holman',
            'email' => 'markh@gmail.com',
            'password' => bcrypt('12312345'),
            'role' => $role->name
        ]);

        $permission = Permission::where('name', 'product-list')->pluck('id');
        $role->syncPermissions($permission);

        $user->assignRole([$role->id]);

    }
}
