<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeerBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeer_branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('musteri_id');
            $table->string('employeer_title');
            $table->string('tax');
            $table->string('tax_no');
            $table->string('website')->nullable();
            $table->string('workplace_registration_number');
            $table->string('commercial_registration_number');
            $table->string('address');
            $table->timestamps();

            $table->foreign('musteri_id')->on('musteris')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employeer_branches');
    }
}
