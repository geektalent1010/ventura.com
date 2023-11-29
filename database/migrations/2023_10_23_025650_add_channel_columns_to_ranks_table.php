<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChannelColumnsToRanksTable extends Migration
{
    public function up(): void
    {
        Schema::table('ranks', function (Blueprint $table): void {
            $table->integer('channel1')->nullable()->after('partner_group');
            $table->integer('channel2')->nullable()->after('channel1');
            $table->boolean('is_active')->nullable()->default(1)->after('channel2');
        });
    }

    public function down(): void
    {
        Schema::table('ranks', function (Blueprint $table): void {
            $table->dropColumn('channel1');
            $table->dropColumn('channel2');
            $table->dropColumn('is_active');
        });
    }
}
