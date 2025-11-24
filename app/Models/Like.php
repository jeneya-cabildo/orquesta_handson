<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Like extends Model
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
        'tweet_id',
    ];

    /**
     * Get the user that owns the like.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the tweet that was liked.
     */
    public function tweet()
    {
        return $this->belongsTo(\App\Models\Tweet::class);
    }
}