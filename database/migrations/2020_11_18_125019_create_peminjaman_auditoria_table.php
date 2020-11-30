<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanAuditoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_auditoria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained()->cascadeOnDelete();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->string('tglPinjam');
            $table->string('dariJam');
            $table->string('sampaiJam');
            $table->string('kegiatan');
            $table->string('noTelp')->nullable();
            $table->string('email')->nullable();
            $table->string('image');
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
        Schema::dropIfExists('peminjaman_auditoria');
    }
}
