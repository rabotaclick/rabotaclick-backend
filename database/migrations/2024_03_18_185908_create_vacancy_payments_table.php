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
        Schema::create('vacancy_payments', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->timestamps();
            $table->enum('status',       ['pending',  'completed', 'failed'])->default('pending');
            $table->enum('vacancy_type', ['standard', 'premium']);
            $table->integer('summary');
            $table->dateTime('payed_at')->nullable();
            $table->string('transaction_id')->nullable();
            $table->foreignUuid('vacancy_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('user_employer_id')->constrained()->noActionOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancy_payments');
    }
};
