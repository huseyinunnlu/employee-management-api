<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('musteri_id');
            $table->unsignedBigInteger('city_id');
            $table->string('logo')->nullable();
            $table->string('title');
            $table->string('email');
            $table->string('address');
            $table->timestamps();

            $table->foreign('musteri_id')->on('musteris')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('companies');
    }
}
