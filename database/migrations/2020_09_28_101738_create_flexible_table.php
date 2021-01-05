<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlexibleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flexible', function (Blueprint $table) {
            $table->id();
            $table->string('bid');
            $table->string('userid');
            $table->integer('status');
            $table->integer('l1');
            $table->integer('l2');
            $table->integer('l3');
            $table->integer('l4');
            $table->integer('l5');
            $table->integer('l6');
            $table->integer('s1');
            $table->integer('s2');
            $table->integer('s3');
            $table->integer('s4');
            $table->integer('i1');
            $table->integer('i2');
            $table->integer('i3');
            $table->integer('i4');
            $table->integer('i5');
            $table->string('rep');
            $table->integer('ctime');
            $table->integer('o1');
            $table->integer('o2');
            $table->integer('o3');
            $table->integer('o4');
            $table->integer('o5');
            $table->integer('o6');
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
        Schema::dropIfExists('flexible');
    }
}
