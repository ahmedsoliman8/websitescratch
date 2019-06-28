<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class Skills extends Seeder
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
                'name'=>$faker->word
            ];
            \App\Models\Skill::create($array);
        }
    }
}
