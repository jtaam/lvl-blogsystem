<?php

use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 150; $i++) {
            DB::table('post_tag')->insert(
                [
                    'post_id' => rand(1, 100),
                    'tag_id' => rand(1, 43),
                ]
            );
        }
    }
}
