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
            $table->text('NUMBER');
            $table->text('NUMBER2')->nullable();
            $table->text('WEIGHT')->nullable();
            $table->text('VPE')->nullable();
            $table->text('VIN')->nullable();
            $table->text('NL')->nullable();
            $table->text('TITLE')->nullable();
            $table->text('TEILEART')->nullable();
            // $table->string('name')->nullable();
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
