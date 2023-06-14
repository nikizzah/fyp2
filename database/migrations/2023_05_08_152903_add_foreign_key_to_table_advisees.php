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
        Schema::table('advisees', function (Blueprint $table) {
            $table->string('advisor_id')->nullable();
            $table->unsignedInteger('cs_id')->nullable();

            $table->foreign('cs_id')->references('cs_id')->nullable()->on('course_structures')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('advisor_id')->nullable()->references('advisor_id')->on('advisors')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advisees', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['cs_id']);
            $table->dropForeign(['advisor_id']);
            
            // Drop columns
            $table->dropColumn('advisor_id');
            $table->dropColumn('cs_id');
        });
    }

    /**
     * Get the migration dependencies.
     *
     * @return array
     */
    public function before()
    {
        return [
            create_advisors_table::class,
            create_course_structures_table::class,
        ];
    }
};
