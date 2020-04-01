<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text("description");
            $table->bigInteger("company_id")->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->text('wanted_profile');
            $table->text("additional_information")->nullable();
            $table->boolean('first_semester_possibility');
            $table->boolean('project_possibility');
            $table->string('mentor_name');
            $table->string('mentor_function');
            $table->string('mentor_mail');
            $table->string('mentor_phone');
            $table->string('confirmed')->nullable();
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
        Schema::dropIfExists('internships');
    }
}
