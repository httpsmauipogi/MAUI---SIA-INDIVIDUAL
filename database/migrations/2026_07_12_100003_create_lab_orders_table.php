<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->unique()->nullable();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('doctor_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('lab_test_id')->constrained()->cascadeOnDelete();
            $table->decimal('price', 10, 2)->default(0);
            $table->enum('status', ['Pending', 'Sample Collected', 'Processing', 'Completed', 'Cancelled'])->default('Pending');
            $table->date('ordered_date');
            $table->dateTime('sample_collected_at')->nullable();
            $table->dateTime('result_date')->nullable();
            $table->text('result_notes')->nullable();
            $table->string('result_file')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_orders');
    }
};
