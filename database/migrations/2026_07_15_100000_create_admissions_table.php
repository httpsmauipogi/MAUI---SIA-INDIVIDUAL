<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->string('admission_no')->unique()->nullable();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('doctor_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('bed_id')->constrained()->cascadeOnDelete();
            $table->dateTime('admission_date');
            $table->date('expected_discharge_date')->nullable();
            $table->dateTime('discharge_date')->nullable();
            $table->string('reason');
            $table->text('diagnosis')->nullable();
            $table->enum('status', ['Admitted', 'Discharged'])->default('Admitted');
            $table->text('discharge_notes')->nullable();
            $table->foreignId('admitted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
