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
        Schema::create('detail_child', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('no_nota');
            $table->foreign('no_nota')->references('no_nota')->on('services')->onDelete('cascade');
            
            $table->integer('kd_barang');
                $table->decimal('harga', 10, 3 ); 
            $table->timestamps();
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_child');
    }
};
