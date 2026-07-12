<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beds', function (Blueprint $table) {
            $table->id();
            $table->string('bed_number')->unique();
            $table->string('ward');
            $table->string('floor')->nullable();
            $table->enum('status', ['Available', 'Occupied', 'Maintenance'])->default('Available');
            $table->foreignId('patient_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamp('occupied_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beds');
    }
};
