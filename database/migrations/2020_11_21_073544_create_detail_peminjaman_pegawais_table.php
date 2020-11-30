<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPeminjamanPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_peminjaman_pegawais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peminjaman_pegawai_id');
            $table->foreign('peminjaman_pegawai_id')->references('id')->on('peminjaman_auditorium_pegawais')->onDelete('cascade');
            $table->string('fasilitas');
            $table->string('jumlah')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('detail_peminjaman_pegawais');
    }
}
