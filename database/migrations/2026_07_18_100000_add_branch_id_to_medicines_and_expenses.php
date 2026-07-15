<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('medicines', 'branch_id')) {
            Schema::table('medicines', function (Blueprint $table) {
                $table->foreignId('branch_id')->nullable()->after('id')->constrained()->nullOnDelete();
            });
        }

        if (Schema::hasTable('expenses') && ! Schema::hasColumn('expenses', 'branch_id')) {
            Schema::table('expenses', function (Blueprint $table) {
                $table->foreignId('branch_id')->nullable()->after('id')->constrained()->nullOnDelete();
            });
        }

        // Existing records fall under the main branch so nothing disappears.
        $mainBranchId = DB::table('branches')->where('is_main', true)->value('id')
            ?? DB::table('branches')->orderBy('id')->value('id');

        if ($mainBranchId) {
            DB::table('medicines')->whereNull('branch_id')->update(['branch_id' => $mainBranchId]);

            if (Schema::hasTable('expenses')) {
                DB::table('expenses')->whereNull('branch_id')->update(['branch_id' => $mainBranchId]);
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('medicines', 'branch_id')) {
            Schema::table('medicines', function (Blueprint $table) {
                $table->dropConstrainedForeignId('branch_id');
            });
        }

        if (Schema::hasTable('expenses') && Schema::hasColumn('expenses', 'branch_id')) {
            Schema::table('expenses', function (Blueprint $table) {
                $table->dropConstrainedForeignId('branch_id');
            });
        }
    }
};
