<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // database/migrations/create_leave_requests_table.php

public function up()
{
    Schema::dropIfExists('leave_requests');
    Schema::create('leave_requests', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employee_id');
        $table->foreign('employee_id')->references('id')->on('employees');
        $table->unsignedBigInteger('leave_id');
        $table->foreign('leave_id')->references('id')->on('leave_type');
        $table->date('start_date');
        $table->date('end_date');
        $table->integer('many_days');
        $table->text('reason');
        $table->text('document')->nullable();
        $table->boolean('approved_by_supervisor')->default(false);
        $table->boolean('approved_by_hr')->default(false);
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
        Schema::dropIfExists('leave_requests');
    }
}
