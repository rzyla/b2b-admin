<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_pages', function (Blueprint $table) {
            $table->id();
            $table->integer('language_id');
            $table->string('symbol');
            $table->string('title');
            $table->string('lead')->nullable();
            $table->string('description')->nullable();
            $table->boolean('published')->default(false);
            $table->string('meta_title')->nullable();
            $table->string('meta_words')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_pages');
    }
};
