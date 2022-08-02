<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert(array(
            'name' => 'admin',
            'email' => 'admin@sedjoek.id',
            'username' => NULL,
            'phone' => NULL,
            'roles' => 'ADMIN',
            'email_verified_at' => NULL,
            'password' => 'admin',
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->where('name','=','admin')->delete();
    }
};
