<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Akun (Owner & Pelanggan)
        Schema::create('akun_rental', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik', 16)->unique();
            $table->text('alamat');
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->enum('role', ['owner', 'pelanggan'])->default('pelanggan');
            $table->timestamps();
        });

        // 2. Tabel Armada Mobil
        Schema::create('tabel_armada', function (Blueprint $table) {
            $table->string('plat_nomor', 15)->primary();
            $table->string('merk', 50);
            $table->integer('tahun');
            $table->enum('transmisi', ['Manual', 'Matic']);
            $table->timestamps();
        });

        // 3. Tabel Paket Rental
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->enum('jenis', ['Lepas Kunci', 'All-in', 'Luar Kota']);
            $table->integer('durasi');
            $table->text('ketentuan');
            $table->timestamps();
        });

        // 4. Tabel Driver / Pengemudi
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('umur');
            $table->integer('pengalaman_pengemudi');
            $table->string('nomor_sim_aktif');
            $table->string('kontak');
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drivers');
        Schema::dropIfExists('pakets');
        Schema::dropIfExists('tabel_armada');
        Schema::dropIfExists('akun_rental');
    }
};