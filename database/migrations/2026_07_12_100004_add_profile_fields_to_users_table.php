<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('employee_id')->nullable()->unique()->after('id');
            $table->string('avatar')->nullable()->after('password');
            $table->string('phone')->nullable()->after('avatar');
            $table->string('designation')->nullable()->after('phone');
            $table->string('department')->nullable()->after('designation');
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable()->after('department');
            $table->date('date_of_birth')->nullable()->after('gender');
            $table->date('joining_date')->nullable()->after('date_of_birth');
            $table->string('blood_group')->nullable()->after('joining_date');
            $table->text('address')->nullable()->after('blood_group');
            $table->enum('status', ['Active', 'Inactive'])->default('Active')->after('address');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'employee_id', 'avatar', 'phone', 'designation', 'department',
                'gender', 'date_of_birth', 'joining_date', 'blood_group', 'address', 'status',
            ]);
        });
    }
};
