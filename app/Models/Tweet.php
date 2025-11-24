<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        // 'likes' and 'retweets' are usually derived counts and are removed from $fillable
    ];

    /**
     * The user who posted the tweet.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function edits()
    {
        return $this->hasMany(TweetEdit::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function retweets()
    {
        return $this->hasMany(Retweet::class);
    }

    /**
     * Check if the tweet has been liked by the given user.
     * This is the method that was missing and causing the BadMethodCallException.
     *
     * @param \App\Models\User $user
     * @return bool
     */
   // In app/Models/Tweet.php
public function isLikedBy(User $user)
{
    return $this->likes()->where('user_id', $user->id)->exists();
}

    /**
     * Check if the tweet has been retweeted by the given user.
     * This method is also necessary for the logic in the Blade template.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function isRetweetedBy(\App\Models\User $user): bool
    {
        // Checks the 'retweets' relationship for an existing record tied to the current user.
        return $this->retweets()->where('user_id', $user->getAuthIdentifier())->exists();
    }
}
