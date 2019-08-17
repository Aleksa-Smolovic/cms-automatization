<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();

    	for($i = 0; $i < 49; $i++) {
    		User::create([
                'role_id' => $faker->numberBetween($min = 1, $max = 2),
    			'first_name' => $faker->firstName,
    			'last_name'  => $faker->lastName,
    			'username'   => $faker->username,
    			'email'		   => $faker->email,
    			'password' 	 => Hash::make('123456')
    		]);
    	}

        User::create([
        'role_id'    => 1,
        'first_name' => 'test_ime',
        'last_name'  => 'test_prezime',
        'username'   => 'test',
        'email'      => 'test@email.com',
        'password'   => Hash::make('123456')
        ]);
    }
  }

