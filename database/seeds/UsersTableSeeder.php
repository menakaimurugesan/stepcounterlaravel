<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		foreach(range(1,10) as $index)
		{			
			DB::table('users')->insert([
				'name' => str_random(15),
				'email' => str_random(15).'@gmail.com',
				'password' => bcrypt('secret')
			]);
		}
    }
}
