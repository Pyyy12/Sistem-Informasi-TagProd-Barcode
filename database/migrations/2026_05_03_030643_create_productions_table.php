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
    Schema::create('productions', function (Blueprint $table) {
        $table->id();
        $table->string('item_code')->unique(); // Kode unik barang
        $table->string('item_name');           // Nama barang
        $table->string('batch_number');        // Nomor batch produksi
        $table->date('production_date');       // Tanggal produksi
        $table->string('operator_name');       // Nama operator
        $table->integer('quantity');           // Jumlah produksi
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productions');
    }
};
