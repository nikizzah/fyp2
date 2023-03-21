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
        Schema::create('advisors', function (Blueprint $table) {
            $table->string('advisor_id')->primary();
            $table->string('advisor_password')->default('');
            $table->string('advisor_name')->default('');
            $table->string('advisor_ext')->default('');
            $table->string('advisor_email')->default('');
            $table->string('advisor_quota')->default('0');
            $table->string('advisor_position')->default('');
            //$table->string('advisor_status')->default('');
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
        Schema::dropIfExists('advisors');
    }
};
