<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Tweet extends Model
{
    use HasFactory;

    /**
     * Use the default primary key `id` (defined by migration).
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'content',
    ];

    /**
     * Load relationship counts automatically
     *
     * @var array
     */
    protected $withCount = ['likes', 'retweets', 'edits'];

    /**
     * Get the user that owns the tweet.
     */
    public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'user_id');
}

    /**
     * Get the likes for the tweet.
     */
    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }

    /**
     * Get the retweets for the tweet.
     */
    public function retweets()
    {
        return $this->hasMany(\App\Models\Retweet::class);
    }

    /**
     * Get the edit history for the tweet.
     */
    public function edits()
    {
        return $this->hasMany(\App\Models\TweetEdit::class);
    }

    /**
     * Check if the tweet is liked by a specific user.
     */
    public function isLikedBy(?User $user): bool
    {
        if (! $user) {
            return false;
        }

        $uid = $user->getAuthIdentifier();

        return $this->likes()->where('user_id', $uid)->exists();
    }

    /**
     * Check if the tweet is retweeted by a specific user.
     */
    public function isRetweetedBy(?User $user): bool
    {
        if (! $user) {
            return false;
        }

        $uid = $user->getAuthIdentifier();

        return $this->retweets()->where('user_id', $uid)->exists();
    }
}