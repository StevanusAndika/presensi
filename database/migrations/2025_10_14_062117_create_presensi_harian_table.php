<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presensi_harian', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('tgl_masuk');
            $table->dateTime('tgl_pulang')->nullable();
            $table->char('ket_hari', 1);
            $table->char('nip', 9);
            $table->string('ip_masuk', 15);
            $table->string('ip_keluar', 15)->nullable();

           
            $table->unsignedBigInteger('peta_kehadiran_id');

            $table->time('jam_harus_masuk');
            $table->time('jam_harus_pulang');

            // Foreign keys
            $table->foreign('peta_kehadiran_id')
                  ->references('id')
                  ->on('peta_kehadiran')
                  ->onDelete('cascade');

            $table->foreign('nip')
                  ->references('nip')
                  ->on('pengguna')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_harian');
    }
};
