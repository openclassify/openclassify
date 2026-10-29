<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("CREATE INDEX listings_public_feed_index ON listings (is_featured DESC, created_at DESC, id DESC) WHERE deleted_at IS NULL AND status = 'active'");
        DB::statement("CREATE INDEX listings_public_category_index ON listings (category_id, created_at DESC, id DESC) WHERE deleted_at IS NULL AND status = 'active'");
    }

    public function down(): void
    {
        DB::statement('DROP INDEX IF EXISTS listings_public_category_index');
        DB::statement('DROP INDEX IF EXISTS listings_public_feed_index');
    }
};
