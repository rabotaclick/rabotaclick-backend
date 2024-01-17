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
        Schema::create('user_phone_changes', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->string("code_crypt");
            $table->foreignUuid("user_id")->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_phone_changes');
    }
};
