<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->string('event_date')->nullable();
            $table->string('main_featured_image_url')->nullable();
            $table->string('small_featured_image_url1')->nullable();
            $table->string('small_featured_image_url2')->nullable();
            $table->string('small_featured_image_url3')->nullable();
            $table->text('followers')->nullable();
            $table->integer('type')->nullable()->default(0);
            $table->boolean('is_active')->nullable()->default(1);
            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
