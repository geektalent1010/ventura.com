<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubjectColumnsToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->text('subject')->nullable()->after('description');
            $table->text('content')->nullable()->after('subject');
            $table->string('small_featured_image_url4')->nullable()->after('small_featured_image_url3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('subject');
            $table->dropColumn('content');
            $table->dropColumn('small_featured_image_url4');
        });
    }
}
