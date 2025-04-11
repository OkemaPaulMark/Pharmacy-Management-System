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
        Schema::table('add_medicines', function (Blueprint $table) {
            $table->unsignedBigInteger('medicine_id')->after('description');
        });
    }
    
    public function down(): void
    {
        Schema::table('add_medicines', function (Blueprint $table) {
            $table->dropColumn('medicine_id');
        });
    }
    
};
