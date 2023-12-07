<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectsTable extends Migration
{
    public function up()
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->id('prospect_id');
            $table->string('last_name', 50);
            $table->string('first_name', 50);
            $table->string('email', 100);
            $table->string('phone', 15);
            $table->string('address', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prospects');
    }
}
