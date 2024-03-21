<?php declare(strict_types=1);
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
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();

            $table->enum('type', ['individual', 'project', 'person', 'self-employed', 'recruiter', 'agency']);
            $table->string('name');
            $table->string('website')->nullable();
            $table->string('phone');
            $table->text('description')->nullable();
            $table->foreignUuid('city_id')->constrained()->noActionOnDelete();
            $table->foreignUuid('specialization_id')->constrained()->noActionOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
