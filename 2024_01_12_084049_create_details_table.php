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
        Schema::create('details', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->bigInteger('no_nota')->unsigned(); 
            $table->foreign('no_nota')->references('no_nota')->on('services')->onDelete('cascade');
            $table->foreignId('kd_cust');
            $table->integer('jumlah') ;
            $table->integer('subtotal') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};
