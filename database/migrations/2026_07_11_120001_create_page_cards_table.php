<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Flexible, reorderable content blocks used to build the repeatable
     * card/list sections on each frontend page (services, features, FAQs,
     * gallery images, blog posts, hero slides, etc). group_key lets a single
     * page have more than one independent list (e.g. home has "hero_slides"
     * and "services").
     */
    public function up(): void
    {
        Schema::create('page_cards', function (Blueprint $table) {
            $table->id();
            $table->string('page_key');
            $table->string('group_key')->default('default');
            $table->string('icon')->nullable();
            $table->string('image_path')->nullable();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('link_text')->nullable();
            $table->string('link_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['page_key', 'group_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_cards');
    }
};
