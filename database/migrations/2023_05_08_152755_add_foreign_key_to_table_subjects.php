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
        Schema::table('subjects', function (Blueprint $table) {
            $table->unsignedInteger('cs_id')->nullable();
            $table->foreign('cs_id')->references('cs_id')->nullable()->on('course_structures')->onUpdate('cascade')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropForeign(['cs_id']);
            
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
            create_course_structures_table::class,
        ];
    }
};
