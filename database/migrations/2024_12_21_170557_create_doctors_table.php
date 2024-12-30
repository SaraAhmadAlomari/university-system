<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('password');
            $table->string('email')->nullable()->unique();
            $table->foreignId('nationality_id')->constrained('nationalities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('gender_id')->constrained('genders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('religion_id')->constrained('religions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('classroom_id')->constrained('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('faculty_id')->constrained('faculties')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
};
