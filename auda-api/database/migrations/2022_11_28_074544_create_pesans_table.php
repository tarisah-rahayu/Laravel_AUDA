<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesans', function (Blueprint $table) {
            $table->id('id_pesan');
            $table->unsignedBigInteger('id_supplier');
            $table->unsignedBigInteger('id_karyawan');
            $table->unsignedBigInteger('id_barang');
            $table->string('satuan_pesanan');
            $table->string('status_pesanan');
            $table->date('tanggal_pesan');
            $table->date('tanggal_terima');
            $table->timestamps();
            $table->foreign('id_supplier')->references('id_supplier')->on('supliers');
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawans');
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
        Schema::dropIfExists('pesans');
    }
}
