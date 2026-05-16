<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Stats (500+, 15K+, ...)
        Schema::create('about_stats', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('label');
            $table->string('label_ar')->nullable();
            $table->string('icon')->default('fa-star');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Team members
        Schema::create('about_team', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->string('role_ar')->nullable();
            $table->text('bio')->nullable();
            $table->text('bio_ar')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Values (Quality, Trust, ...)
        Schema::create('about_values', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_ar')->nullable();
            $table->text('description');
            $table->text('description_ar')->nullable();
            $table->string('icon')->default('fa-star');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_values');
        Schema::dropIfExists('about_team');
        Schema::dropIfExists('about_stats');
    }
};
