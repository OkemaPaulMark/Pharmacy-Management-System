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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('allergies')->nullable();
            $table->string('blood_group')->nullable();
            $table->date('dob');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->string('phone');
            $table->text('address');
            $table->string('caretaker');
            $table->string('caretaker_phone');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
