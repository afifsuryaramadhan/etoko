<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->text('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->text('gambar')->nullable();
            $table->string('roles')->default('user');

            $table->integer('provinces_id')->nullable();
            $table->integer('regencies_id')->nullable();
            $table->integer('districts_id')->nullable();
            $table->string('toko')->nullable();
            $table->text('sku')->nullable();;
            $table->string('status')->nullable();;

            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
