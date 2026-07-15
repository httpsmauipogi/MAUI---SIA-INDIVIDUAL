<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Real foreign keys - replaces the free-text "branch" column that was
        // used only for display. branch_id is what access control relies on.
        if (! Schema::hasColumn('users', 'branch_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->foreignId('branch_id')->nullable()->after('id')->constrained()->nullOnDelete();
            });
        }

        if (! Schema::hasColumn('doctors', 'branch_id')) {
            Schema::table('doctors', function (Blueprint $table) {
                $table->foreignId('branch_id')->nullable()->after('id')->constrained()->nullOnDelete();
            });
        }

        if (! Schema::hasColumn('patients', 'branch_id')) {
            Schema::table('patients', function (Blueprint $table) {
                $table->foreignId('branch_id')->nullable()->after('id')->constrained()->nullOnDelete();
            });
        }

        if (! Schema::hasColumn('beds', 'branch_id')) {
            Schema::table('beds', function (Blueprint $table) {
                $table->foreignId('branch_id')->nullable()->after('id')->constrained()->nullOnDelete();
            });
        }

        // Backfill branch_id from the old free-text branch name, where it
        // matches an existing Branch record, so nobody's data goes "unassigned".
        if (Schema::hasColumn('users', 'branch')) {
            DB::statement('UPDATE users SET branch_id = (SELECT id FROM branches WHERE branches.name = users.branch LIMIT 1) WHERE branch_id IS NULL AND branch IS NOT NULL');
        }
        if (Schema::hasColumn('doctors', 'branch')) {
            DB::statement('UPDATE doctors SET branch_id = (SELECT id FROM branches WHERE branches.name = doctors.branch LIMIT 1) WHERE branch_id IS NULL AND branch IS NOT NULL');
        }

        // Anything still unassigned (including all existing patients and
        // beds, which never had a branch concept before) falls under the
        // main branch, so existing data stays visible to Super/Hospital
        // Admin and doesn't just disappear.
        $mainBranchId = DB::table('branches')->where('is_main', true)->value('id')
            ?? DB::table('branches')->orderBy('id')->value('id');

        if ($mainBranchId) {
            DB::table('users')->whereNull('branch_id')->update(['branch_id' => $mainBranchId]);
            DB::table('doctors')->whereNull('branch_id')->update(['branch_id' => $mainBranchId]);
            DB::table('patients')->whereNull('branch_id')->update(['branch_id' => $mainBranchId]);
            DB::table('beds')->whereNull('branch_id')->update(['branch_id' => $mainBranchId]);
        }
    }

    public function down(): void
    {
        foreach (['users', 'doctors', 'patients', 'beds'] as $tableName) {
            if (Schema::hasColumn($tableName, 'branch_id')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropConstrainedForeignId('branch_id');
                });
            }
        }
    }
};
