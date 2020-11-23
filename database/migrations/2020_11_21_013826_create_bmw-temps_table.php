<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBmwTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bmw-temps', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('kod');
            $table->float('price');
            $table->integer('zalog');
            $table->integer('rg');
            $table->float('zakup');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bmw-temps');
    }
}
