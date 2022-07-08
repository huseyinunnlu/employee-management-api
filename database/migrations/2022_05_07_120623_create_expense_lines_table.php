<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_lines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expense_id');
            $table->unsignedBigInteger('type_id');
            $table->date('date');
            $table->string('file')->nullable();
            $table->string('desc')->nullable();
            $table->decimal('price', 12, 2);

            $table->timestamps();
            $table->foreign('expense_id')->on('expenses')->references('id')->onDelete('cascade');
            $table->foreign('type_id')->on('expense_types')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_lines');
    }
}
