<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    // Only create the table if it doesn't already exist
    if (!Schema::hasTable('tweets')) {
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id'); // assuming based on logs
            $table->text('content');
            $table->integer('likes')->default(0);
            $table->integer('retweets')->default(0);
            $table->timestamps();
        });
    }
}

    public function down()
    {
        Schema::dropIfExists('tweets');
    }
};
