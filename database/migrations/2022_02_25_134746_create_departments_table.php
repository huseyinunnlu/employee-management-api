<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('city_id');
            $table->string('title');
            $table->float('mountly_holiday');
            $table->float('daily_work_hour');
            $table->float('overtime_rate');
            $table->enum('overtime_type', ['common', 'mall']);
            $table->boolean('food_fee_tax')->default(false);
            $table->boolean('road_fee_tax')->default(false);
            $table->timestamps();

            $table->foreign('company_id')->on('companies')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('departments');
    }
}
