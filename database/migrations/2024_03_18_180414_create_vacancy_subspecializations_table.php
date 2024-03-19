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
        Schema::create('vacancy_subspecializations', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid("vacancy_id")->constrained()->cascadeOnDelete();
            $table->foreignUuid("subspecialization_id")->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancy_subspecializations');
    }
};
