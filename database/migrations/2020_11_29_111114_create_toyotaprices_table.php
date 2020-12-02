<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToyotapricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toyotaprices', function (Blueprint $table) {
            $table->timestamps();
            $table->string('NUMBER')->unique();
            $table->string('NUMBER2')->nullable();
            $table->string('WEIGHT')->nullable();
            $table->string('VPE')->nullable();
            $table->string('VIN')->nullable();
            $table->string('NL')->nullable();
            $table->string('TITLE')->nullable();
            $table->string('TEILEART')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('toyotaprices');
    }
}
