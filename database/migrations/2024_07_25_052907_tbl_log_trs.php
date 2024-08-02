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
        if(!Schema::hasTable('log_transaksi')) {
            Schema::create('log_transaksi', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('trs_id')->nullable();
                $table->text('barang_id')->nullable();
               $table->date('tgl');
           
            });
        };
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_transaksi');

    }
};
