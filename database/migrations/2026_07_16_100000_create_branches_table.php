<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('manager_name')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->boolean('is_main')->default(false);
            $table->timestamps();
        });

        // Doctors already have a free-text "branch" column - staff didn't,
        // so add the same simple text field to users for consistency. Kept
        // as plain strings (matched by branch name) rather than a foreign
        // key, so existing doctor records with a typed-in branch name don't
        // need a data migration.
        if (! Schema::hasColumn('users', 'branch')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('branch')->nullable()->after('department');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'branch')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('branch');
            });
        }

        Schema::dropIfExists('branches');
    }
};
