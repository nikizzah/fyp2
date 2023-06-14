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
        Schema::create('advisee_subject', function (Blueprint $table) {
            $table->id();
            $table->string('advisee_id')->nullable();
            $table->unsignedInteger('subject_id')->nullable();
            $table->unsignedInteger('cs_id')->nullable();
            $table->string('subject_semester')->nullable();
            $table->string('subject_grade')->nullable();
            $table->foreign('advisee_id')->references('advisee_id')->on('advisees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('subject_id')->references('subject_id')->on('subjects')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('cs_id')->references('cs_id')->on('course_structures')->onUpdate('cascade')->onDelete('cascade');
            
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
        Schema::dropIfExists('advisee_subject');
    }
};
