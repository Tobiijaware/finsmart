<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEwalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ewallet', function (Blueprint $table) {
            $table->id();
            $table->string('trno');
            $table->string('bid');
            $table->string('userid');
            $table->float('cos');
            $table->integer('ctime');
            $table->integer('mm');
            $table->integer('status');
            $table->integer('type');
            $table->string('remark');
            $table->string('rep');
            $table->string('opt');
            $table->integer('mark');
            $table->string('ref');
            $table->string('ref2');
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
        Schema::dropIfExists('ewallet');
    }
}
