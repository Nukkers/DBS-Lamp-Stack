<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserRoleAsString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add the column to the users table, tracks the roles of the users  
        Schema::table('users', function($table){
            $table->string('user_role')->default('default');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Delete the role column from the users table
        Schema::table('users', function($table){
            $table->dropColumn('user_role');
        });
    }
}
