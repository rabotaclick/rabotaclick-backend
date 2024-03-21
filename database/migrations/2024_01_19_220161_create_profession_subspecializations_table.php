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
        Schema::create('profession_subspecializations', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('profession_id');
            $table->foreignUuid('subspecialization_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profession_subspecialization');
    }
};
