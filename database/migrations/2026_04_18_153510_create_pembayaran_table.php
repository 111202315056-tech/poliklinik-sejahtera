<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_daftar_poli')->constrained('daftar_poli');
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status', ['menunggu','sudah_bayar','lunas'])->default('menunggu');
            $table->timestamp('tgl_bayar')->nullable();
            $table->timestamp('tgl_konfirmasi')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('pembayaran');
    }
};