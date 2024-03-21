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
        Schema::create('education_places', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->enum('education', [
                'secondary',
                'secondary_specialized',
                'incomplete_higher',
                'higher',
                'bachelor',
                'master',
                'candidate',
                'doctor'
            ]);
            $table->string("name");
            $table->string("faculty");
            $table->string("specialization");
            $table->integer("year_of_ending");
            $table->foreignUuid("resume_id")->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_place');
    }
};
