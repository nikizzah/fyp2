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
                $table->string('advisee_status')->default('');
                $table->string('advisee_cgpa')->default('');
                $table->string('advisee_calculateCGPA')->nullable();
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
        Schema::dropIfExists('advisees');
    }
};
