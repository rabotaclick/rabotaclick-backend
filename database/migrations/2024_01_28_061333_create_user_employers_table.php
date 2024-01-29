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
        Schema::create('user_employers', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('lastname')->nullable();

            $table->string('phone')->unique();
            $table->string('email')->unique();

            $table->string('password')->nullable();

            $table->foreignUuid('company_id')->constrained('companies')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_employer');
    }
};
