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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('salesman_id');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->string('total_bill'); 
            $table->decimal('taxes', 8, 2)->nullable()->default(0.0);
            $table->decimal('discount', 8, 2)->nullable()->default(0.0);
            $table->string('discount_reason')->nullable()->default('None');
            $table->string('discount_type')->nullable()->default('None');
            $table->decimal('received_cash', 8, 2);
            $table->decimal('return_change', 8, 2);
            $table->string('ordertype')->nullable();
            $table->integer('status')->default('2');
            
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('salesman_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
