<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaksi_id')->unsigned()->nullable();;
            $table->foreign('transaksi_id')->references('id')->on('transaksi');
            $table->integer('keranjang_id')->unsigned()->nullable();;
            $table->foreign('keranjang_id')->references('id')->on('keranjang');
            $table->integer('user_id')->unsigned()->nullable();;
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('resi');
            $table->string('kode');
            $table->softDeletes();
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
        Schema::dropIfExists('transaksi_detail');
    }
}
