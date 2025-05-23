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
        Schema::table('add_medicines', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->after('category');
        });
    }
    
    public function down()
    {
        Schema::table('add_medicines', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
