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

        User::create([
        'role_id'    => 1,
        'full_name' => 'test_ime',
        'email'      => 'test@email.com',
        'password'   => Hash::make('123456')
        ]);
    }
  }

