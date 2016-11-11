<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tasks', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title', 128 );
            $table->string('message', 512);
            $table->integer('state');
            $table->time('created');
            $table->time('modified');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('tasks');
    }
}
