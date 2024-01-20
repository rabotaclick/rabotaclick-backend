<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('resume_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('resume_id')->constrained()->noActionOnDelete();
            $table->foreignUuid('language_id')->constrained()->cascadeOnDelete();
            $table->enum('level', ['A1', 'A2', 'B1', 'B2', 'C1', 'C2']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_languages');
    }
};
