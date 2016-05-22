<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('name','255');
            $table->string('address','255');
            $table->string('phone','255');
            $table->string('email','255');
            $table->integer('job_id_for')->unsigned();
            $table->integer('attendee_id_for')->unsigned();
            $table->string('extra_guest','255');
            $table->string('dinner','255');
            $table->string('paper','255');
            $table->timestamps();

            $table->foreign('job_id_for')->references('job_id')->on('tbl_jobs');
            $table->foreign('attendee_id_for')->references('attendee_id')->on('tbl_attendee_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_users');
    }
}
