<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRanksTable extends Migration
{
    public function up()
    {
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('level')->nullable();
            $table->integer('profit')->nullable();
            $table->integer('customers')->nullable();
            $table->integer('partners')->nullable();
            $table->integer('partner_group')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ranks');
    }
}
