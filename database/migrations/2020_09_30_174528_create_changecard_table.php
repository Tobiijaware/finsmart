<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangecardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('changecard', function (Blueprint $table) {
            $table->integer('sn');
            $table->string('bid');
            $table->string('userid');
            $table->string('response');
            $table->string('email');
            $table->string('ctime');
            $table->string('ref');
            $table->float('amount');
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
        Schema::dropIfExists('changecard');
    }
}
