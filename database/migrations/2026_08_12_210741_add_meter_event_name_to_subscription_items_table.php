<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscription_items', function (Blueprint $table): void {
            $table->string('meter_event_name')->nullable()->after('quantity');
        });
    }

    public function down(): void
    {
        Schema::table('subscription_items', function (Blueprint $table): void {
            $table->dropColumn('meter_event_name');
        });
    }
};
