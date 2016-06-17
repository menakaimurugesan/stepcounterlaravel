<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $faker = Faker::create();
        
        $users = App\User::lists('id')->toArray();
			
        foreach(range(1,50) as $index){
			
			$year = rand(2009, 2016);
			$month = rand(1, 12);
			$day = rand(1, 28);
			$time = rand(0,23);

			$randDate = Carbon::create($year,$month ,$day , $time, 0, 0);
					
			DB::table('activities')->insert([
				'date' => $randDate,
				'steps' => rand(1,5000),
				'user_id' => $faker->randomElement($users)
			]);
			
        }
    }
}
