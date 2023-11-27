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
        Schema::create('achievement_employee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('achievement_id');
            $table->unsignedBigInteger('employee_id');
            $table->date('achievement_date');
            $table->timestamps();

            $table->foreign('achievement_id')->references('id')->on('achievements')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievement_employee');
    }
};
