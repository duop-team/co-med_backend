<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = ["admin", "staff", "doctor", "user"];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role
            ]);
        }

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@comed',
            'password' => Hash::make('admin123'),
            'phone' => '+380681234567',
            'role_id' => 1
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
