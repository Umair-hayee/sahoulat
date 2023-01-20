<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('roles')->truncate();
        Schema::enableForeignKeyConstraints();

        $student = Role::create([
            'name' => 'Buyer',
            'guard_name' => 'web'
        ]);

        $mentor = Role::create([
            'name' => 'Seller',
            'guard_name' => 'web'
        ]);

        $mentor = Role::create([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);
    }
}
