<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBmwpricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bmwprices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('NUMBER');
            $table->bigInteger('NUMBER2');
            $table->integer('WEIGHT');
            $table->lineString('VPE');
            $table->lineString('VIN');
            $table->lineString('NL');
            $table->lineString('TITLE');
            $table->lineString('TEILEART');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bmwprices');
    }
}
