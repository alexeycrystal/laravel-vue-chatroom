<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'name' => 'John Johnson',
            'email' => 'john@gmail.com',
            'password' => bcrypt('password1')
        ]);
        User::create([
            'name' => 'Timmy Morgan',
            'email' => 'timmy@yahoo.com',
            'password' => bcrypt('password2')
        ]);
        $faker = Factory::create();
        User::truncate();
        foreach(range(1, 3) as $i) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('password')
            ]);
        }
    }
}
