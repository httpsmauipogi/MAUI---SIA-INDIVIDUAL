<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('name');
            $table->string('branch')->nullable()->after('consultation_fee');
            $table->string('floor')->nullable()->after('branch');
            $table->string('room_no')->nullable()->after('floor');
        });
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['photo', 'branch', 'floor', 'room_no']);
        });
    }
};
