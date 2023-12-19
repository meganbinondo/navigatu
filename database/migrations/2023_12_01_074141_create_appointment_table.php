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
        Schema::create('appointment', function (Blueprint $table) {
            $table->id('appointment_no');
            //$table->foreignId('user_id')->constrained('users');
            $table->foreignId('id')->references('id')->on('users');
            //$table->foreignId('area_id')->references('area_id')->on('area');
            $table->string('area');
            $table->string('details');
            
            $table->time('start_time');
            $table->time('end_time');
            $table->string('status')->nullable();
            $table->date('event_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment');
    }
};