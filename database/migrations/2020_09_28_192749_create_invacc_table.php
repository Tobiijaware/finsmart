<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvaccTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invacc', function (Blueprint $table) {
            $table->integer('sn');
            $table->string('bid');
            $table->string('userid');
            $table->integer('ref');
            $table->string('amount');
            $table->string('rate');
            $table->string('interest');
            $table->float('prorate');
            $table->float('profee');
            $table->integer('tranch');
            $table->integer('tenure');
            $table->integer('start');
            $table->integer('stop');
            $table->string('mm');
            $table->string('terminate');
            $table->string('created');
            $table->string('status');
            $table->string('type');
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
        Schema::dropIfExists('invacc');
    }
}
