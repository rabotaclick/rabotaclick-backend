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
        Schema::create('driver_categories', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->enum('category', ['A','B','C','D','E','BE','CE','DE','Tm','Tb']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_categories');
    }
};
