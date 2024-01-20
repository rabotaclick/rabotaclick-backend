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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('lastname')->nullable();

            $table->string("phone")->unique();
            $table->string("change_phone")->nullable();

            $table->string('email')->nullable()->unique();
            $table->string('change_email')->nullable();

            $table->enum('status', ['active', 'considering', 'offered', 'already_got', 'not_looking'])->default('considering');

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
