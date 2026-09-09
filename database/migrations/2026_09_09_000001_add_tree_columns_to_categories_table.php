<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Self-referencing parent (null = root category)
            $table->unsignedBigInteger('parent_id')->nullable()->after('id');
            // Short description / notes shown in admin tree
            $table->text('description')->nullable()->after('image');
            // Sort order within siblings
            $table->unsignedInteger('sort_order')->default(0)->after('description');

            $table->foreign('parent_id')
                  ->references('id')
                  ->on('categories')
                  ->nullOnDelete();

            $table->index('parent_id');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropIndex(['parent_id']);
            $table->dropColumn(['parent_id', 'description', 'sort_order']);
        });
    }
};
