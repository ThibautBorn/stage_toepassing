<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('field_name');
            $table->timestamps();
        });

        Schema::create('options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("field_id")->unsigned();
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
            $table->string('option_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
}
