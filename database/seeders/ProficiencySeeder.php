<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proficiency;

class ProficiencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $proficiency = Proficiency::create([
            'name' => 'Excellent'
        ]);

        $proficiency = Proficiency::create([
            'name' => 'Fluent'
        ]);

        $proficiency = Proficiency::create([
            'name' => 'Average'
        ]);

        $proficiency = Proficiency::create([
            'name' => 'Native'
        ]);

    }
}
