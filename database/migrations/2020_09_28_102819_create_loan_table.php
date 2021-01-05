<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan', function (Blueprint $table) {
            $table->id();
            $table->integer('ref');
            $table->string('bid');
            $table->string('userid');
            $table->integer('amount');
            $table->double('rate');
            $table->double('interest');
            $table->double('prorate');
            $table->double('profee');
            $table->double('advisory')->nullable();
            $table->double('insurance')->nullable();
            $table->double('tranch')->nullable();
            $table->integer('tenure')->nullable();
            $table->string('start')->nullable();
            $table->string('stop')->nullable();
            $table->double('terminate')->nullable();
            $table->integer('status');
            $table->integer('type')->nullable();
            $table->string('rep')->nullable();
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
        Schema::dropIfExists('loan');
    }
}
