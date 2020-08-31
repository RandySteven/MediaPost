<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect(['programming', 'samsung', 'xiaomi', 'Inggris', 'Paris', 'London', 'oppo', 'Sultan Mahmmud']);
        $tags->each(function($c){
            Tag::create([
                'name'=>$c,
                'slug'=>\Str::slug($c)
            ]);
        });
    }
}
