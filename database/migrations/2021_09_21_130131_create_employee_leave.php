<?php

use Brick\Math\BigInteger;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeLeave extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_leave', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('emp_id');
            $table->string('status');
            $table->date('date');
            $table->string('reason');
            $table->date('leave_start_date');
            $table->date('leave_end_date');
            $table->foreign('emp_id')->references('id')->on('employees')->onDelete('cascade');
            $table->bigIncrements('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_leave');
    }
}
