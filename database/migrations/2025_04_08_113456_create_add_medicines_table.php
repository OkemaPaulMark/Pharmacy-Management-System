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
        Schema::create('add_medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Medicine Name
            $table->string('category');
            $table->decimal('unit_price', 10, 2); // Unit Price
            $table->integer('quantity');
            $table->string('supplier');
            $table->date('expiry_date');
            $table->text('description')->nullable();
            $table->timestamps();
            
            // Optional indexes for better performance
            $table->index('category');
            $table->index('supplier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_medicines');
    }
};
