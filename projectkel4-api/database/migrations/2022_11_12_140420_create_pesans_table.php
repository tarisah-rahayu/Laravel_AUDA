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
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_barang');
            $table->integer('jumlah_pesan');
            $table->string('status_pesan');
            $table->date('tanggal_pesan');
            $table->date('tanggal_terima');
            $table->timestamps();
            $table->foreign('id_supplier')->references('id_supplier')->on('suppliers');
            $table->foreign('id_admin')->references('id_adminn')->on('admins');
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
