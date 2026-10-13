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
        Schema::create('skema_sertifikasis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_skema')->unique(); //Unik
            $table->string('nama_skema');
            $table->text('deskripsi')->nullable(); //ga boleh kosong
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skema_sertifikasis');
    }
};
