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
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peserta');
            $table->string('nisn', 10)->unique();
            $table->string('jenis_kelamin', 20);
            $table->string('email')->nullable();
            $table->string('no_telepon', 20)->nullable();
            $table->string('alamat')->nullable();

            $table->foreignId('skema_sertifikasi_id')
                ->constrained('skema_sertifikasis')
                ->restrictOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
