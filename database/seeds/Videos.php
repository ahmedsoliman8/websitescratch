<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class Videos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();

        $images=[
          '15599174656MWsnicRzo.jpg',
          '1559938936ffndO9YbUd.jpg'
        ];
        $youtube=[
            'https://www.youtube.com/watch?v=TIhton7vyFc&list=PLYp_Kd32XvcqW5GIocnA-M3DKUK6_7aDa&index=55&t=0s',
            'https://www.youtube.com/watch?v=_dkh2ri4TFQ&list=PLYp_Kd32XvcqW5GIocnA-M3DKUK6_7aDa&index=56&t=0s',
            'https://www.youtube.com/watch?v=Ztvjny7YSP4',
            'https://www.youtube.com/watch?v=V1NI2rrThbo'
        ];
        $ids=[1,2,3,4,5,6,7,8,9];
        for ($i=0;$i<10;$i++){
            $array=[
                'name'=>$faker->word,
                'meta_keywords'=>$faker->name,
                'meta_des'=>$faker->name,
                'des'=>$faker->paragraph,
                'youtube'=>$youtube[rand(0,3)],
                'published'=>rand(0,1),
                'user_id'=>1,
                'cat_id'=>1,
                'image'=>$images[rand(0,1)]
            ];
           $video= \App\Models\Video::create($array);
           $video->skills()->sync(array_rand($ids,2));
            $video->tags()->sync(array_rand($ids,2));

        }
    }
}
