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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->integer('no')->default(1);
            $table->string('type')->defult('retail');
            $table->string('shop')->nullable();
            $table->string('pos')->nullable();
            $table->string('cashier')->nullable();
            $table->string('receipt_no')->nullable();
            $table->string('receipt_barcode')->nullable();
            
            $table->string('client')->nullable();
            $table->decimal('total',15,2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
