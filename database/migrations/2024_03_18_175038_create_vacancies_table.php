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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->string('title');
            $table->integer('salary_from');
            $table->integer('salary_to')->nullable();
            $table->boolean('gpc');
            $table->text('responsibilities');
            $table->text('requirements');
            $table->text('conditions');

            $table->enum('salary_type',     ['in_hand','before_taxes']);
            $table->enum('work_experience', ['zero','one_to_three','three_to_six','more_than_six']);
            $table->enum('occupation',      ['full-time', 'part-time', 'project', 'volunteer', 'internship']);
            $table->enum('work_type',       ['full_job','part_job']);
            $table->enum('schedule',        ['full', 'shift', 'flexible', 'remote', 'rotation']);
            $table->enum('education',       ['not_required','high','college']);

            $table->string('contact_name');
            $table->string('contact_surname');
            $table->string('contact_lastname');
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->text('letter');

            $table->boolean('is_active')->default(false);

            $table->foreignUuid('city_id')->constrained()->noActionOnDelete();
            $table->foreignUuid('company_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
