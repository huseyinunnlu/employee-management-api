<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('type_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('day_type', ['full', 'half-morning', 'half-afternoon', 'hourly'])->default('full');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('place')->nullable();
            $table->enum('status', ['accepted', 'rejected', 'pending'])->default('pending');
            $table->timestamps();

            $table->foreign('type_id')->on('absence_types')->references('id')->onDelete('cascade');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absences');
    }
}
