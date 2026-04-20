<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->boolean('circa')->default(false);
            $table->foreignId('location_id')->nullable()->constrained('locations')->nullOnDelete();
            $table->enum('historical_period', [
                'pre_terremoto',
                'terremoto_1970',
                'reconstruccion',
                'siglo_xxi',
            ])->nullable();
            $table->string('original_format')->nullable();
            $table->string('source_archive')->nullable();
            $table->string('source_reference')->nullable();
            $table->string('image_path')->nullable();
            $table->string('image_url', 2048)->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
            $table->index('location_id');
            $table->index('historical_period');
            $table->index('is_published');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
