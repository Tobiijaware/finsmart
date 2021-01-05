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
            $table->string('bid');
            $table->string('userid');
            $table->string('surname')->nullable();
            $table->string('othername')->nullable();
            $table->string('sponsor')->nullable();
            $table->string('active')->nullable();
            $table->string('email')->unique();
            $table->string('sex')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('birthday')->nullable();
            $table->string('accname')->nullable();
            $table->string('bank')->nullable();
            $table->string('accountno')->nullable();
            $table->string('bvn')->nullable();
            $table->string('name')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('status')->nullable();         
            $table->string('rep')->nullable();
            $table->string('photo')->nullable();
            $table->integer('code')->nullable();
            $table->string('ctime')->nullable();
            $table->integer('cat')->nullable();
            $table->string('keyy')->nullable();
            $table->rememberToken();
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
        Schema::table('users', function (Blueprint $table) {
           $table->dropColumn('user_id');
        });
    }
}
