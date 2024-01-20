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
        Schema::create('resumes', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->softDeletes();

            $table->string('profession')->nullable();

            $table->string("surname");
            $table->string("name");
            $table->string("lastname");
            $table->string('phone');
            $table->date('birthdate');

            $table->enum("gender", ["male", "female"]);
            $table->enum('ready_to_move', ['no', 'yes', 'want']);
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

            $table->foreignUuid("city_id")->nullable()->constrained()->nullOnDelete();
            $table->foreignUuid("citizenship_country_id")->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignUuid("work_permit_country_id")->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
