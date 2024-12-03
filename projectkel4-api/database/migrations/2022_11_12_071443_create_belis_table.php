<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('belis', function (Blueprint $table) {
            $table->id('id_beli');
            $table->unsignedBigInteger('id_konsumen');
            $table->unsignedBigInteger('id_barang');
            $table->string('alamat_penerima');
            $table->date('tanggal_beli');
            $table->date('tanggal_kirim');
            $table->integer('qty');
            $table->string('status');
            $table->timestamps();
            $table->foreign('id_konsumen')->references('id_konsumen')->on('konsumens');
            $table->foreign('id_barang')->references('id_barang')->on('barangs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('belis');
    }
}
