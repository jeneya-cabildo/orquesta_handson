<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            // users table in this app uses 'user_id' as primary key
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tweet_id');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete();
            $table->foreign('tweet_id')->references('id')->on('tweets')->cascadeOnDelete();

            $table->unique(['user_id', 'tweet_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
