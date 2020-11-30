<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanUmumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_umums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('nik');
            $table->string('nama');
            $table->string('alamat');
            $table->string('noTelp')->nullable();
            $table->string('email')->nullable();
            $table->string('tglPinjam');
            $table->string('dariJam');
            $table->string('sampaiJam');
            $table->string('kegiatan');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('peminjaman_umums');
    }
}
