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
        Schema::table('equipments', function (Blueprint $table) {
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
        });

        Schema::table('spares', function (Blueprint $table) {
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
        });
        
        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });

        Schema::table('customer_transactions', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('equipment_id')->references('id')->on('equipments');
            $table->foreign('spare_id')->references('id')->on('spares');
            $table->foreign('service_id')->references('id')->on('services');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('equipment_id')->references('id')->on('equipments')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('spare_id')->references('id')->on('spares')->onDelete('cascade');
        });

        Schema::table('shippings', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('equipment_id')->references('id')->on('equipments');
            $table->foreign('spare_id')->references('id')->on('spares');
            $table->foreign('shipped_by')->references('id')->on('employees');
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });

        Schema::table('supplier_transactions', function (Blueprint $table) {
            $table->foreign('inventory_id')->references('id')->on('inventories');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
