<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Summary of LeaveType
 */
class CreateLeaveType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_type', function (Blueprint $table) {
            $table->id();
            $table->string('leave_name');
            $table->boolean('document');
            $table->boolean('deduct_leave');
            $table->boolean('deduct_long_leave');
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
        Schema::dropIfExists('leave_type');
    }
}
