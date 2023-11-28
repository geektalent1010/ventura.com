<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelsTable extends Migration
{
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('receive_user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('channel_unique_name');
            $table->string('last_read_message_sid')->nullable();
            $table->dateTime('last_message_readed_at')->nullable();
            $table->boolean('is_connected')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('channels');
    }
}
