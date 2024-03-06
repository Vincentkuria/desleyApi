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
        Schema::create('supplier_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_from');
            $table->unsignedBigInteger('inventory_id');
            $table->unsignedBigInteger('supplier_id');
            $table->integer('count');
            $table->float('total_amount',8,2)->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->json('status')->default(json_encode(['manager'=>'pending']));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_transactions');
    }
};
