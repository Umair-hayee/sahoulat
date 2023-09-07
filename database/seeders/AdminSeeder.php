<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::find(3);
        $user = User::create([
            'name' => 'System User',
            'email' => 'admin@sahoulat.com',
            'password' => Hash::make('secret'),
        ]);
        $user->assignRole($role);
    }
}
