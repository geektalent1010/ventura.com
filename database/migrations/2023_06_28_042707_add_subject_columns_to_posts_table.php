<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubjectColumnsToPostsTable extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table): void {
            $table->text('subject')->nullable()->after('description');
            $table->text('content')->nullable()->after('subject');
            $table->string('small_featured_image_url4')->nullable()->after('small_featured_image_url3');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table): void {
            $table->dropColumn('subject');
            $table->dropColumn('content');
            $table->dropColumn('small_featured_image_url4');
        });
    }
}
