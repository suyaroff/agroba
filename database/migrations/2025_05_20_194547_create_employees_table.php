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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('passport_number', 9)->unique();
            $table->string('last_name', 20);
            $table->string('first_name', 20);
            $table->string('middle_name', 20)->nullable();
            $table->string('position', 50);
            $table->string('phone', 15);
            $table->string('address');
            $table->foreignId('enterprise_id')->constrained('enterprises')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
