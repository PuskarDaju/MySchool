<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutinesTable extends Migration
{
    public function up()
    {
        Schema::create('routines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('period');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            // Prevent same teacher double booking in same period
            $table->unique(['teacher_id', 'period']);

            // One subject/teacher per class/period
            $table->unique(['class_id', 'period']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('routines');
    }
}
