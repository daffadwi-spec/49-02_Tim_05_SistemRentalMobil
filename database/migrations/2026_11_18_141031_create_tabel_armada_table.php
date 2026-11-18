<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tabel_armada')) {
            Schema::create('tabel_armada', function (Blueprint $table) {
                $table->string('plat_nomor', 15)->primary();
                $table->string('merk', 50);
                $table->integer('tahun');
                $table->enum('transmisi', ['Manual', 'Matic']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tabel_armada');
    }
};