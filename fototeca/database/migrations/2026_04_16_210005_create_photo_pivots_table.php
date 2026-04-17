<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('photo_photographer', function (Blueprint $table) {
            $table->foreignId('photo_id')->constrained()->cascadeOnDelete();
            $table->foreignId('photographer_id')->constrained()->cascadeOnDelete();
            $table->string('role')->default('photographer');
            $table->primary(['photo_id', 'photographer_id']);
        });

        Schema::create('photo_category', function (Blueprint $table) {
            $table->foreignId('photo_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->primary(['photo_id', 'category_id']);
        });

        Schema::create('photo_tag', function (Blueprint $table) {
            $table->foreignId('photo_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->primary(['photo_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photo_tag');
        Schema::dropIfExists('photo_category');
        Schema::dropIfExists('photo_photographer');
    }
};
