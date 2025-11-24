<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('retweets')) {
            Schema::create('retweets', function (Blueprint $table) {
                $table->id('retweet_id');
                $table->unsignedBigInteger('tweet_id');
                $table->unsignedBigInteger('user_id');
                $table->timestamps();

                // Add indexes
                $table->unique(['tweet_id', 'user_id'], 'unique_retweet');
                $table->index('tweet_id');
                $table->index('user_id');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('retweets');
    }
};
