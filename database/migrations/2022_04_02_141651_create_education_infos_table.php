<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['primary', 'secondary', 'high', 'licence', 'graduate', 'doctorate', 'associate']);
            $table->string('url')->nullable();
            $table->string('title')->nullable();
            $table->string('graduated_school');
            $table->float('certificate_grade')->nullable();
            $table->string('department')->nullable();
            $table->year('start_year');
            $table->year('finish_year');
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
        Schema::dropIfExists('education_infos');
    }
}
