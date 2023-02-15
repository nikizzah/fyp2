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
        Schema::create('subjects', function (Blueprint $table) {
            $table->string('subject_code')->unique();
            $table->string('subject_name')->default('');
            $table->string('subject_credithr')->default('');
            $table->string('subject_prerequisite')->default('');
            $table->string('subject_category')->default('');
            $table->string('subject_semester')->default('');
            $table->string('subject_year')->default('');
            $table->string('subject_grade')->default('');
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
        Schema::dropIfExists('subjects');
    }
};
