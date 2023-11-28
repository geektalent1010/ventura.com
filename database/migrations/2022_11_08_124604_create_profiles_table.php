<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthday');
            $table->string('main_avatar_url')->nullable();
            $table->string('other_avatar_url1')->nullable();
            $table->string('other_avatar_url2')->nullable();
            $table->string('other_avatar_url3')->nullable();
            $table->string('other_avatar_url4')->nullable();
            $table->string('other_avatar_url5')->nullable();
            $table->string('other_avatar_url6')->nullable();
            $table->string('other_avatar_url7')->nullable();
            $table->string('other_avatar_url8')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('job_title')->nullable();
            $table->string('main_interests')->nullable();
            $table->string('other_interests')->nullable();
            $table->text('story_content')->nullable();
            $table->text('trash_buddies')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
