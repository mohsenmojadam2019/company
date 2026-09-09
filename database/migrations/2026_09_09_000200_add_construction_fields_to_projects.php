<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table): void {
            $table->string('location', 160)->nullable()->after('client');
            $table->string('status', 60)->nullable()->after('location');
            $table->unsignedSmallInteger('units')->nullable()->after('status');
            $table->unsignedSmallInteger('floors')->nullable()->after('units');
            $table->unsignedInteger('area')->nullable()->after('floors');
            $table->string('year', 12)->nullable()->after('area');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table): void {
            $table->dropColumn(['location', 'status', 'units', 'floors', 'area', 'year']);
        });
    }
};
