<?php

use Illuminate\Database\Seeder;

class PostUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 150; $i++) {
            DB::table('post_user')->insert(
                [
                    'post_id' => rand(1, 100),
                    'user_id' => rand(1, 20),
                ]
            );
        }
    }
}
