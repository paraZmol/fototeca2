<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('photographers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pseudonym')->nullable();
            $table->unsignedSmallInteger('birth_year')->nullable();
            $table->unsignedSmallInteger('death_year')->nullable();
            $table->string('nationality')->nullable()->default('Peruana');
            $table->text('biography')->nullable();
            $table->string('portrait_path')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photographers');
    }
};
