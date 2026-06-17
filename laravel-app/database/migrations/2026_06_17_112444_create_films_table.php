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
Schema::create('films', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('description');
    $table->year('release_year');
    $table->integer('genre_id');
    $table->integer('duration');
    $table->string('poster')->nullable();
    $table->integer('rating')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
