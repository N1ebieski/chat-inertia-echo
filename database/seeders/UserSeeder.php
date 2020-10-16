<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate(['email' => 'john@doe.com'], [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => Hash::make('password')
        ]);

        $user->assignRole('user');

        $admin = User::firstOrCreate(['email' => 'mario@admin.com'], [
            'name' => 'Mario Admin',
            'email' => 'mario@admin.com',
            'password' => Hash::make('password')
        ]);

        $admin->assignRole('super-admin');
    }
}
