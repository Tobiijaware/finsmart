<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings', function (Blueprint $table) {
            $table->id();
            $table->integer('ref');
            $table->string('bid');
            $table->string('userid');
            $table->integer('amount');
            $table->string('period');
            $table->string('type');
            $table->float('rate');
            $table->float('rate2');
            $table->integer('start');
            $table->integer('stop');
            $table->integer('mm');
            $table->integer('status');
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
        Schema::dropIfExists('savings');
    }
}
