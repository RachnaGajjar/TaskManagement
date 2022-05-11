<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('employees', 'email'))
        {
            Schema::table('employees', function (Blueprint $table)
            {
                $table->dropColumn('email');
            });
        }
        if (Schema::hasColumn('employees', 'password'))
        {
            Schema::table('employees', function (Blueprint $table)
            {
                $table->dropColumn('password');
            });
        }
        if (!Schema::hasColumn('employees', 'user_id'))
        {
            Schema::table('employees', function (Blueprint $table)
            {
                $table->unsignedBigInteger('user_id');
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function($table) {
            $table->string('email');
            $table->string('password');
            $table->dropColumn('user_id');
         });
    }
}
