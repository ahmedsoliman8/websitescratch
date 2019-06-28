<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class Comments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for ($i=0;$i<10;$i++){
            $array=[
                'user_id'=>1,
                'video_id'=>rand(1,9),
                'comment'=>$faker->paragraph
            ];
            \App\Models\Comment::create($array);
        }

    }
}
