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
        Schema::create('resume_key_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid("resume_id")->constrained()->cascadeOnDelete();
            $table->foreignUuid("key_skill_id")->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_key_skills');
    }
};
