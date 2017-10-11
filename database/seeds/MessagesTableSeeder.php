<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Message;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        Message::truncate();
        foreach(range(1, 3) as $i) {
            Message::create([
                'user_id' => $i,
                'message' => $faker->sentence
            ]);
        }
    }
}
