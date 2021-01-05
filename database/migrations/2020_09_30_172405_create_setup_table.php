<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setup', function (Blueprint $table) {
            $table->integer('sn');
            $table->string('bid');
            $table->string('phone');
            $table->string('phone2');
            $table->string('address');
            $table->string('email');
            $table->string('url');
            $table->float('company');
            $table->float('savint');
            $table->float('invint');
            $table->float('loanint');
            $table->float('profee');
            $table->float('tax');
            $table->string('bank');
            $table->string('accno');
            $table->string('bank2');
            $table->string('accno2');
            $table->string('accname');
            $table->string('senderid');
            $table->string('rep');
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
        Schema::dropIfExists('setup');
    }
}
