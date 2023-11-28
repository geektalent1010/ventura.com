<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('customer_id')->nullable()->after('id');
            $table->integer('sponsor_id')
                ->unsigned()
                ->default(0)
                ->after('customer_id');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('customer_id');
            $table->dropColumn('sponsor_id');
        });
    }
}
