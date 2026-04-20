<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('photographers', function (Blueprint $table) {
            // renombrar campos existentes al esquema estandar
            $table->renameColumn('name',      'full_name');
            $table->renameColumn('biography', 'bio');
        });

        Schema::table('photographers', function (Blueprint $table) {
            // nuevos campos del esquema requerido
            $table->string('birth_place')->nullable()->after('full_name');
            $table->date('birth_date')->nullable()->after('birth_place');
            $table->string('death_place')->nullable()->after('birth_date');
            $table->date('death_date')->nullable()->after('death_place');
            $table->text('studies_critique')->nullable()->after('bio');
            $table->string('portrait_url', 2048)->nullable()->after('studies_critique');
        });

        Schema::table('photographers', function (Blueprint $table) {
            // eliminar columnas que el nuevo esquema no necesita
            $table->dropColumn([
                'pseudonym',
                'birth_year',
                'death_year',
                'nationality',
                'portrait_path',
                'is_anonymous',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('photographers', function (Blueprint $table) {
            $table->renameColumn('full_name', 'name');
            $table->renameColumn('bio',       'biography');
        });

        Schema::table('photographers', function (Blueprint $table) {
            $table->dropColumn([
                'birth_place',
                'birth_date',
                'death_place',
                'death_date',
                'studies_critique',
                'portrait_url',
            ]);
        });

        Schema::table('photographers', function (Blueprint $table) {
            $table->string('pseudonym')->nullable();
            $table->unsignedSmallInteger('birth_year')->nullable();
            $table->unsignedSmallInteger('death_year')->nullable();
            $table->string('nationality')->nullable();
            $table->string('portrait_path')->nullable();
            $table->boolean('is_anonymous')->default(false);
        });
    }
};
