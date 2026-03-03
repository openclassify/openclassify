<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('listings', function (Blueprint $table): void {
            if (! Schema::hasColumn('listings', 'view_count')) {
                $table->unsignedInteger('view_count')->default(0)->after('is_featured');
            }
        });
    }

    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table): void {
            if (Schema::hasColumn('listings', 'view_count')) {
                $table->dropColumn('view_count');
            }
        });
    }
};
