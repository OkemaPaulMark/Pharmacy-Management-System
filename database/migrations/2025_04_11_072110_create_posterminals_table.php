<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('posterminals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_id')->constrained('add_medicines');
            $table->foreignId('category_id')->constrained('categories');
            $table->decimal('unit_price', 8, 2);
            $table->integer('quantity');
            $table->decimal('total', 10, 2);
            $table->text('prescription')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posterminals');
    }
};
