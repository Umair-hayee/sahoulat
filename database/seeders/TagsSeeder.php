<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('tags')->truncate();
        DB::table('sub_tags')->truncate();
        Schema::enableForeignKeyConstraints();

        Tag::create([
            'name' => 'Graphics',
        ]);

        Tag::create([
            'name' => 'Videography',
        ]);

        Tag::create([
            'name' => 'Writing',
        ]);

        Tag::create([
            'name' => 'Business',
        ]);

        Tag::create([
            'name' => 'Data',
        ]);

        Tag::create([
            'name' => 'AI',
        ]);

        Tag::create([
            'name' => 'Programming',
        ]);

        Tag::create([
            'name' => 'Website Development',
        ]);

        Tag::create([
            'name' => 'Digital Marketing',
        ]);

    }
}
