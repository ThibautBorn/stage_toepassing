<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string("department")->nullable();
            $table->text("description");
            $table->string('street');
            $table->string('number');
            $table->string('municipality');
            $table->integer('zipcode');
            $table->string('admin_name');
            $table->string('admin_function');
            $table->string('admin_mail');
            $table->string('admin_phone');

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
        Schema::dropIfExists('companies');
    }
}
