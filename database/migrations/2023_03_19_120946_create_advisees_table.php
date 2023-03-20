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
        if(!Schema::hasTable('advisees')) {
        Schema::create('advisees', function (Blueprint $table) {
            $table->string('advisee_id')->primary();
            $table->string('advisee_password')->default('');
            $table->string('advisee_fname')->default('');
            $table->string('advisee_address')->default('');
            $table->string('advisee_town')->default('');
            $table->string('advisee_state')->default('');
            $table->string('advisee_postcode')->default('');
            $table->string('advisee_email')->default('');
            $table->string('advisee_contact')->default('');
            //$table->string('advisee_status')->default('');
            $table->string('advisee_cgpa')->default('');
            $table->timestamps();
        });
        }

        Schema::table('advisees', function (Blueprint $table) {
            $table->foreignId('subject_code')->default('')->references('subject_code')->on('subjects');
            $table->foreignId('advisor_id')->default('')->references('advisor_id')->on('advisors');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advisees');
    }
};
