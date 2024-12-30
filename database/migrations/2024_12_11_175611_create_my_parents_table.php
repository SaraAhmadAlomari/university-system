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
        Schema::create('my_parents', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('relation', 50)->nullable(); // e.g., Father, Mother, Guardian
            $table->foreignId('gender_id')->constrained('genders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('relegion_id')->constrained('religions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('nationality_id')->constrained('nationalities')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('my_parents');
    }
};
