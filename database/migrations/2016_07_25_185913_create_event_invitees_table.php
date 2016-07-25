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
            $table->unsignedInteger("user_id");
            $table->primary(["event_id", "user_id"]);
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
