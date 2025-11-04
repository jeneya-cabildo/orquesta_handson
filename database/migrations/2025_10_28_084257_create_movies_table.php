<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::create('movies', function (Blueprint $table) {
        $table->id();
        $table->string('title', 255);
        $table->integer('rating')->checkBetween(1, 5);
        $table->text('review');
        $table->string('poster')->nullable(); // optional movie poster URL
        $table->string('genre')->nullable();  // Action, Comedy, etc.
        $table->year('release_year')->nullable(); // Year of release
        $table->timestamps();
    });
}



    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
