<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tweet;

class Retweet extends Model
{
    use HasFactory;

    protected $primaryKey = 'retweet_id';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'tweet_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tweet()
    {
        return $this->belongsTo(Tweet::class, 'tweet_id', 'id');
    }
}
