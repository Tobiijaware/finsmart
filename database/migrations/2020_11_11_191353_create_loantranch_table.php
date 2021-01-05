<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoantranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loantranch', function (Blueprint $table) {
            $table->integer('id');
            $table->string('ref');
            $table->string('bid');
            $table->string('userid');
            $table->integer('instal');
            $table->integer('loan');
            $table->float('tranch');
            $table->integer('mm');
            $table->integer('paid');
            $table->string('reference');
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
        Schema::dropIfExists('loantranch');
    }
}
