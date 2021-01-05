<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRobjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robject', function (Blueprint $table) {
            $table->integer('sn');
            $table->string('bid');
            $table->string('userid');
            $table->string('obj');
            $table->string('ref');
            $table->string('email');
            $table->string('status');
            $table->integer('reset');
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
        Schema::dropIfExists('robject');
    }
}
