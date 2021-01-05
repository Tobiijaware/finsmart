<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsetupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productsetup', function (Blueprint $table) {
            $table->id();
            $table->string('bid');
            $table->string('product');
            $table->integer('type');
            $table->integer('min');
            $table->integer('max');
            $table->float('interest');
            $table->float('vat');
            $table->float('profee');
            $table->float('penalty');
            $table->float('advisory');
            $table->float('insurance');
            $table->string('collateral');
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
        Schema::dropIfExists('productsetup');
    }
}
