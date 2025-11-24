<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tweet;

class TweetEdit extends Model
{
    use HasFactory;

    protected $fillable = [
        'tweet_id',
        'user_id',
        'old_content',
        'new_content',
    ];

    public function tweet()
    {
        return $this->belongsTo(Tweet::class, 'tweet_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
