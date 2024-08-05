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
        if(!Schema::hasTable('barang')) {
            Schema::create('barang', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('nama')->nullable();
                $table->text('code')->nullable();
                $table->text('beli')->nullable();
                $table->text('jual')->nullable();
              $table->text('jumlah')->nullable();
              $table->text('lokasi')->nullable();
               $table->text('barcode')->nullable();
               $table->text('satuan')->nullable();
               $table->date('tgl')->nullable();
               $table->text('status')->nullable();
            });
        };
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
