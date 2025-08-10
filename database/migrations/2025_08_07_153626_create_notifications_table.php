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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('to'); // You can change this to an unsignedBigInteger if referring to user ID
            $table->string('path')->nullable(); // Path to attached photo
            $table->timestamps(); // created_at and updated_at
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
