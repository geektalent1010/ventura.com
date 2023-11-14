<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyInfoColumnsToProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('gender')->nullable()->after('birthday');
            $table->string('phone')->nullable()->after('gender');
            $table->string('company_name')->nullable()->after('phone');
            $table->string('site_url')->nullable()->after('company_name');
            $table->string('vat_number')->nullable()->after('site_url');
            $table->string('banner_img_url')->nullable()->after('other_avatar_url8');
            $table->string('logo_url')->nullable()->after('banner_img_url');
            $table->string('street')->nullable()->after('city');
            $table->string('house_number')->nullable()->after('street');
            $table->string('state')->nullable()->after('house_number');
            $table->string('postal_code')->nullable()->after('country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('phone');
            $table->dropColumn('site_url');
            $table->dropColumn('vat_number');
            $table->dropColumn('state');
            $table->dropColumn('house_number');
            $table->dropColumn('logo_url');
            $table->dropColumn('street');
            $table->dropColumn('postal_code');
            $table->dropColumn('gender');
            $table->dropColumn('banner_img_url');
        });
    }
}
