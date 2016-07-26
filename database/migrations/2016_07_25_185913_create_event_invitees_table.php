<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventInviteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_invitees', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedInteger("event_id");
            $table->string("user_id", 80);
            $table->primary(["event_id", "user_id"]);

            $table->foreign("user_id")->references("facebook_id")->on("users");
            $table->foreign("event_id")->references("id")->on("events");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_invitees');
    }
}
