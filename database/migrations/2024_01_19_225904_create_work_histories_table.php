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
        Schema::create('work_histories', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->string("organization");
            $table->string("website_url")->nullable();
            $table->string("job");
            $table->text('description');
            $table->date("start_date");
            $table->date("end_date")->nullable();
            $table->foreignUuid('region_id')->constrained()->noActionOnDelete();
            $table->foreignUuid("resume_id")->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_history');
    }
};
