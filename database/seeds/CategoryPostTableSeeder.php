<?php

use Illuminate\Database\Seeder;

class CategoryPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 150; $i++) {
            DB::table('category_post')->insert(
                [
                    'post_id' => rand(1, 100),
                    'category_id' => rand(1, 20),
                ]
            );
        }
    }
}
