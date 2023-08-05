<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('employees');
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('full_name');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->unsignedBigInteger('title_id');
            $table->foreign('title_id')->references('id')->on('titles');
            $table->date('join_date');
            $table->string('annual_leave')->default(0);
            $table->string('long_leave')->default(0);
            $table->string('carry_over')->default(0);
            // $table->string('npwp')->nullable();
            // $table->string('foto_profil');
            // $table->unsignedBigInteger('position_id');
            // $table->foreign('position_id')->references('id')->on('positions');
            // $table->unsignedBigInteger('family_status_id');
            // $table->foreign('family_status_id')->references('id')->on('family_status');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('employees');
    }
}
