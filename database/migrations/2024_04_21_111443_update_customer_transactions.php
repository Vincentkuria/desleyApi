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
        Schema::table('customer_transactions', function (Blueprint $table) {
            $table->integer('count')->default(1);
        });
        Schema::table('shippings', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->nullable();
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
