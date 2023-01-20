<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $language = Language::create([
            'name' => 'English'
        ]);

        $language = Language::create([
            'name' => 'Urdu'
        ]);

        $language = Language::create([
            'name' => 'Hindi'
        ]);

        $language = Language::create([
            'name' => 'French'
        ]);

    }
}
