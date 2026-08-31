<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Products Table Indexes
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'is_active')) {
                $table->index('is_active', 'idx_products_is_active');
            }
            if (Schema::hasColumn('products', 'category')) {
                $table->index('category', 'idx_products_category');
            }
            if (Schema::hasColumn('products', 'brand')) {
                $table->index('brand', 'idx_products_brand');
            }
            if (Schema::hasColumn('products', 'price')) {
                $table->index('price', 'idx_products_price');
            }
            if (Schema::hasColumns('products', ['is_active', 'is_featured'])) {
                $table->index(['is_active', 'is_featured'], 'idx_products_active_featured');
            }
            if (Schema::hasColumns('products', ['is_active', 'sales_count'])) {
                $table->index(['is_active', 'sales_count'], 'idx_products_active_sales');
            }
            if (Schema::hasColumns('products', ['is_active', 'views_count'])) {
                $table->index(['is_active', 'views_count'], 'idx_products_active_views');
            }
            if (Schema::hasColumns('products', ['is_active', 'created_at'])) {
                $table->index(['is_active', 'created_at'], 'idx_products_active_created');
            }
        });

        // Categories Table Indexes
        if (Schema::hasTable('categories')) {
            Schema::table('categories', function (Blueprint $table) {
                if (Schema::hasColumn('categories', 'is_active')) {
                    $table->index('is_active', 'idx_categories_is_active');
                }
            });
        }

        // Blog Posts Table Indexes
        if (Schema::hasTable('blog_posts')) {
            Schema::table('blog_posts', function (Blueprint $table) {
                if (Schema::hasColumns('blog_posts', ['is_active', 'published_at'])) {
                    $table->index(['is_active', 'published_at'], 'idx_blog_active_published');
                }
            });
        }

        // Downloads Table Indexes
        if (Schema::hasTable('downloads')) {
            Schema::table('downloads', function (Blueprint $table) {
                if (Schema::hasColumns('downloads', ['is_active', 'created_at'])) {
                    $table->index(['is_active', 'created_at'], 'idx_downloads_active_created');
                }
            });
        }

        // Testimonials Table Indexes
        if (Schema::hasTable('testimonials')) {
            Schema::table('testimonials', function (Blueprint $table) {
                if (Schema::hasColumns('testimonials', ['status', 'created_at'])) {
                    $table->index(['status', 'created_at'], 'idx_testimonials_status_created');
                }
            });
        }

        // Brands Table Indexes
        if (Schema::hasTable('brands')) {
            Schema::table('brands', function (Blueprint $table) {
                if (Schema::hasColumn('brands', 'is_active')) {
                    $table->index('is_active', 'idx_brands_is_active');
                }
            });
        }

        // FAQs Table Indexes
        if (Schema::hasTable('faqs')) {
            Schema::table('faqs', function (Blueprint $table) {
                if (Schema::hasColumns('faqs', ['is_active', 'sort_order'])) {
                    $table->index(['is_active', 'sort_order'], 'idx_faqs_active_sort');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_products_is_active');
            $table->dropIndex('idx_products_category');
            $table->dropIndex('idx_products_brand');
            $table->dropIndex('idx_products_price');
            $table->dropIndex('idx_products_active_featured');
            $table->dropIndex('idx_products_active_sales');
            $table->dropIndex('idx_products_active_views');
            $table->dropIndex('idx_products_active_created');
        });

        if (Schema::hasTable('categories')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropIndex('idx_categories_is_active');
            });
        }

        if (Schema::hasTable('blog_posts')) {
            Schema::table('blog_posts', function (Blueprint $table) {
                $table->dropIndex('idx_blog_active_published');
            });
        }

        if (Schema::hasTable('downloads')) {
            Schema::table('downloads', function (Blueprint $table) {
                $table->dropIndex('idx_downloads_active_created');
            });
        }

        if (Schema::hasTable('testimonials')) {
            Schema::table('testimonials', function (Blueprint $table) {
                $table->dropIndex('idx_testimonials_status_created');
            });
        }

        if (Schema::hasTable('brands')) {
            Schema::table('brands', function (Blueprint $table) {
                $table->dropIndex('idx_brands_is_active');
            });
        }

        if (Schema::hasTable('faqs')) {
            Schema::table('faqs', function (Blueprint $table) {
                $table->dropIndex('idx_faqs_active_sort');
            });
        }
    }
};
