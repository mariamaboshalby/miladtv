<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('category');   // Drivers, Software, Manuals, Catalogues
            $table->string('brand')->nullable();
            $table->string('version')->nullable();
            $table->string('size')->nullable();
            $table->string('os')->nullable();
            $table->string('icon')->default('fa-file');
            $table->string('file_url')->nullable();
            $table->integer('downloads')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};
