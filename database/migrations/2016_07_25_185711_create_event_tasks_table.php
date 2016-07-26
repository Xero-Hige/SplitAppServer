<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger("event_id");
            $table->string("assignee", 80);
            $table->string("name");
            $table->decimal("cost");
            $table->boolean("done");
            /**
             * tasks:[fb_id: integer, name: string, done: bool, cost: float]
             */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_tasks');
    }
}
