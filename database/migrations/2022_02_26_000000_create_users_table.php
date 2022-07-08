<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('employeer_branch_id');
            $table->unsignedBigInteger('musteri_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->unsignedBigInteger('work_place_id')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->unsignedBigInteger('job_id')->nullable();
            $table->string('insurance_no')->nullable();
            $table->enum('insurance_status', ['normal', 'retired', 'intern']);
            $table->enum('blood_group', [
                "a-", "a+", "b-", "b+", "0-", "0+", "ab-", "ab+",
            ]);
            $table->date('start_date');
            $table->date('birthday');
            $table->enum('work_type', ['employee', 'advisor', 'articled', 'student', 'intern', 'academician']);
            $table->enum('work_status', ['full', 'part', 'home']);
            $table->enum('mariance_status', ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15"])->nullable();
            $table->date('arrangment_end_date')->nullable();
            $table->string('photo')->default('blank.png');
            $table->enum('disability_status', ['no', '1', '2', '3']);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('id_serie_number')->unique()->nullable();
            $table->string('id_number')->unique()->nullable();
            $table->string('registration_number')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('born_place_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->unsignedBigInteger('nation_id')->nullable();
            $table->boolean('licence_a1')->default(false);
            $table->boolean('licence_a2')->default(false);
            $table->boolean('licence_a')->default(false);
            $table->boolean('licence_b')->default(false);
            $table->boolean('licence_c')->default(false);
            $table->boolean('licence_d')->default(false);
            $table->boolean('licence_e')->default(false);
            $table->boolean('licence_f')->default(false);
            $table->boolean('licence_g')->default(false);
            $table->boolean('licence_h')->default(false);
            $table->boolean('licence_k')->default(false);
            $table->date('licence_date')->nullable();
            $table->enum('military_status', ['delayed', 'completed', 'exempt'])->nullable();
            $table->string('iban')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('important_or_surgeon')->nullable();
            $table->string('address')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('personal_phone')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('whatsapp_phone')->nullable();
            $table->boolean('mon')->default(false);
            $table->boolean('tur')->default(false);
            $table->boolean('wed')->default(false);
            $table->boolean('thu')->default(false);
            $table->boolean('fri')->default(false);
            $table->boolean('sat')->default(false);
            $table->boolean('sun')->default(false);
            $table->boolean('is_smoking')->nullable();
            $table->boolean('can_sign_in')->default(true);
            $table->boolean('can_edit_profile')->default(false);
            $table->boolean('can_edit_email')->default(false);
            $table->boolean('can_see_salary')->default(false);
            $table->integer('pdks_id')->nullable();
            $table->float('exempt_rate')->nullable();
            $table->date('tgb_start_date')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('language_id')->on('languages')->references('id')->onDelete('cascade');
            $table->foreign('position_id')->on('positions')->references('id')->onDelete('cascade');
            $table->foreign('company_id')->on('companies')->references('id')->onDelete('cascade');
            $table->foreign('department_id')->on('departments')->references('id')->onDelete('cascade');
            $table->foreign('work_place_id')->on('work_places')->references('id')->onDelete('cascade');
            $table->foreign('manager_id')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('job_id')->on('jobs')->references('id')->onDelete('cascade');
            $table->foreign('born_place_id')->on('cities')->references('id')->onDelete('cascade');
            $table->foreign('city_id')->on('cities')->references('id')->onDelete('cascade');
            $table->foreign('nation_id')->on('nations')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
