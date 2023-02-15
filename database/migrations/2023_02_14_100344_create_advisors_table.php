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
            $table->string('advisor_id')->unique();
            $table->string('advisor_password');
            $table->string('advisor_name')->default('');
            $table->string('advisor_ext')->default('');
            $table->string('advisee_quota')->default('');
            $table->string('advisee_position')->default('');
            $table->string('advisee_status')->default('');
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
