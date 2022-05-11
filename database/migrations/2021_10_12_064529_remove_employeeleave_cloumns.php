<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveEmployeeleaveCloumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('employee_leave', function (Blueprint $table) 
        {
            $table->dropColumn('status');
            $table->dropColumn('date');
            $table->dropForeign('employee_leave_emp_id_foreign');
            $table->dropColumn('emp_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        
    }
}
