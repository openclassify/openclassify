<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('favorite_listings', function (Blueprint $table): void {
            $table->softDeletes();
        });

        Schema::table('favorite_sellers', function (Blueprint $table): void {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('favorite_listings', function (Blueprint $table): void {
            $table->dropSoftDeletes();
        });

        Schema::table('favorite_sellers', function (Blueprint $table): void {
            $table->dropSoftDeletes();
        });
    }
};
