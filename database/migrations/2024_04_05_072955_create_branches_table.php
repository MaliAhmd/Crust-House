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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('branch_state')->nullable();
            $table->string('branch_city')->nullable(); 
            $table->string('company_name')->nullable();
            $table->string('branch_initial')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('branch_code')->unique()->nullable();
            $table->string('branch_address')->nullable();
            $table->string('branch_web_address')->nullable();
            $table->decimal('max_discount_percentage', 8, 2)->nullable()->default(20);
            $table->string('receipt_message')->nullable();
            $table->string('feedback')->nullable();
            $table->string('receipt_tagline')->nullable();
            $table->boolean('riderOption')->nullable();
            $table->boolean('onlineDeliveryOption')->nullable();
            $table->boolean('DiningOption')->nullable();
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
