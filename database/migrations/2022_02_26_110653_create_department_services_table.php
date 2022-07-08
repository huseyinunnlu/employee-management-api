<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->enum('service_type', ['choosing', 'payroll']);
            $table->enum('comission_type', ['price', 'rate']);
            $table->float('price')->nullable();
            $table->float('rate')->nullable();
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
        Schema::dropIfExists('department_services');
    }
}
