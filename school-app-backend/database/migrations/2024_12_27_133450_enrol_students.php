<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrol_students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('grade'); 
            $table->string('address');
            $table->date('date_of_birth');
            $table->string('phone');
            $table->string('state');
            $table->string('nationality');
            $table->string('school_record');
            $table->string('birth_certificate');
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
        Schema::dropIfExists('enrol_students');

    }
};
