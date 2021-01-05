<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogpayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logpay', function (Blueprint $table) {
            $table->integer('sn');
            $table->string('bid');
            $table->string('userid');
            $table->string('ref');
            $table->string('ref2');
            $table->float('amount');
            $table->integer('status');
            $table->string('ctime1');
            $table->string('ctime');
            $table->string('type');
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
        Schema::dropIfExists('logpay');
    }
}
