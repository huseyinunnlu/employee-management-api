<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_places', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('city_id');
            $table->string('title');
            $table->string('email')->nullable();
            $table->string('morning_start_time')->nullable();
            $table->string('morning_end_time')->nullable();
            $table->integer('morning_break')->nullable();
            $table->string('afternoon_start_time')->nullable();
            $table->string('afternoon_end_time')->nullable();
            $table->integer('afternoon_break')->nullable();
            $table->string('night_start_time')->nullable();
            $table->string('night_end_time')->nullable();
            $table->integer('night_break')->nullable();
            $table->string('full_start_time')->nullable();
            $table->string('full_end_time')->nullable();
            $table->integer('full_break')->nullable();
            $table->string('report_start_time')->nullable();
            $table->string('report_end_time')->nullable();
            $table->integer('report_break')->nullable();
            $table->string('permit_start_time')->nullable();
            $table->string('permit_end_time')->nullable();
            $table->integer('permit_break')->nullable();
            $table->string('annual_permit_start_time')->nullable();
            $table->string('annual_permit_end_time')->nullable();
            $table->integer('annual_permit_break')->nullable();
            $table->timestamps();

            $table->foreign('department_id')->on('departments')->references('id')->onDelete('cascade');
            $table->foreign('city_id')->on('cities')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_places');
    }
}
