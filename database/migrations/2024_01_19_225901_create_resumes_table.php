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

            $table->string('profession')->nullable();

            $table->string("surname");
            $table->string("name");
            $table->string("lastname")->nullable();
            $table->date('birthdate');
            $table->integer('salary');
            $table->boolean("have_car");
            $table->text("about_me");

            $table->string('phone');
            $table->string('email');
            $table->enum('preferred_contact', ['phone','email']);

            $table->enum("gender", ["male", "female"]);
            $table->enum('ready_to_move', ['no', 'yes', 'want']);
            $table->enum('business_trips', ['never', 'ready', 'sometimes']);
            $table->enum('occupation', ['full-time', 'part-time', 'project', 'volunteer', 'internship']);
            $table->enum('schedule', ['full', 'shift', 'flexible', 'remote', 'rotation']);
            $table->enum('travel_time', ['dontcare', 'hour', 'hourhalf']);

            $table->foreignUuid('main_language_id')->constrained('languages')->noActionOnDelete();
            $table->foreignUuid("city_id")->constrained()->noActionOnDelete();
            $table->foreignUuid("citizenship_country_id")->constrained('countries')->noActionOnDelete();
            $table->foreignUuid("work_permit_country_id")->constrained('countries')->noActionOnDelete();
            $table->foreignUuid('user_id')->constrained()->noActionOnDelete();
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
