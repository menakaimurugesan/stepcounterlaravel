<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
<<<<<<< HEAD
			$table->integer('user_id')->unsigned()->index();
=======
			$table->integer('user_id')->unsigned();
>>>>>>> origin/master
            $table->date('date');
			$table->integer('steps');
            $table->timestamps();			
		});
		Schema::table('activities', function($table) {
<<<<<<< HEAD
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
=======
			$table->foreign('user_id')->references('id')->on('users');
>>>>>>> origin/master
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activities');
    }
}
