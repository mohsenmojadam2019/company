<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table): void {
            $table->id(); $table->string('title'); $table->string('slug')->unique(); $table->string('eyebrow')->nullable();
            $table->text('short_description')->nullable(); $table->longText('body')->nullable(); $table->string('icon')->nullable(); $table->string('image')->nullable();
            $table->unsignedInteger('sort_order')->default(0); $table->boolean('is_active')->default(true)->index();
            $table->string('seo_title')->nullable(); $table->text('seo_description')->nullable(); $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table): void {
            $table->id(); $table->string('title'); $table->string('slug')->unique(); $table->string('category')->nullable()->index();
            $table->text('short_description')->nullable(); $table->longText('body')->nullable(); $table->string('image')->nullable(); $table->string('client')->nullable();
            $table->string('project_url')->nullable(); $table->date('completed_at')->nullable(); $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_active')->default(true)->index(); $table->unsignedInteger('sort_order')->default(0); $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable(); $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table): void {
            $table->id(); $table->string('title'); $table->string('slug')->unique(); $table->text('excerpt')->nullable(); $table->longText('body')->nullable();
            $table->string('image')->nullable(); $table->timestamp('published_at')->nullable()->index(); $table->boolean('is_active')->default(true)->index();
            $table->string('seo_title')->nullable(); $table->text('seo_description')->nullable(); $table->timestamps();
        });

        Schema::create('team_members', function (Blueprint $table): void {
            $table->id(); $table->string('name'); $table->string('role')->nullable(); $table->text('bio')->nullable(); $table->string('image')->nullable();
            $table->string('linkedin_url')->nullable(); $table->unsignedInteger('sort_order')->default(0); $table->boolean('is_active')->default(true)->index(); $table->timestamps();
        });

        Schema::create('testimonials', function (Blueprint $table): void {
            $table->id(); $table->string('name'); $table->string('company')->nullable(); $table->text('quote'); $table->string('avatar')->nullable();
            $table->unsignedTinyInteger('rating')->default(5); $table->unsignedInteger('sort_order')->default(0); $table->boolean('is_active')->default(true)->index(); $table->timestamps();
        });

        Schema::create('contact_messages', function (Blueprint $table): void {
            $table->id(); $table->string('name'); $table->string('email'); $table->string('phone')->nullable(); $table->string('company')->nullable();
            $table->string('subject')->nullable(); $table->text('message'); $table->boolean('is_read')->default(false)->index(); $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table): void {
            $table->id(); $table->string('key')->unique(); $table->text('value')->nullable(); $table->string('type')->default('text'); $table->string('group')->default('general')->index(); $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings'); Schema::dropIfExists('contact_messages'); Schema::dropIfExists('testimonials');
        Schema::dropIfExists('team_members'); Schema::dropIfExists('posts'); Schema::dropIfExists('projects'); Schema::dropIfExists('services');
    }
};
