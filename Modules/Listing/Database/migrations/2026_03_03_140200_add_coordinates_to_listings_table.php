<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('listings', function (Blueprint $table): void {
            if (! Schema::hasColumn('listings', 'latitude')) {
                $table->decimal('latitude', 10, 7)->nullable()->after('country');
            }

            if (! Schema::hasColumn('listings', 'longitude')) {
                $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            }
        });
    }

    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table): void {
            if (Schema::hasColumn('listings', 'longitude')) {
                $table->dropColumn('longitude');
            }

            if (Schema::hasColumn('listings', 'latitude')) {
                $table->dropColumn('latitude');
            }
        });
    }
};
