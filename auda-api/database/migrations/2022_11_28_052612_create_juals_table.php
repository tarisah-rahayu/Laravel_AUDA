<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juals', function (Blueprint $table) {
            $table->id('id_jual');
            $table->unsignedBigInteger('id_barang');
            $table->unsignedBigInteger('id_konsumen');
            $table->string('alamat_penerima');
            $table->string('tgl_jual');
            $table->string('tgl_kirim');
            $table->integer('qty');
            $table->string('satuan');
            $table->string('status');
            $table->timestamps();
            $table->foreign('id_barang')->references('id_barang')->on('barangs');
            $table->foreign('id_konsumen')->references('id_konsumen')->on('konsumens');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('juals');
    }
}
