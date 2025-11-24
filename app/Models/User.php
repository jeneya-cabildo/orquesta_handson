<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'user_id'; // FIX: Changed from 'id' to 'user_id'

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'user_id'; // FIX: Changed from 'id' to 'user_id'
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->user_id; // FIX: Changed from $this->id to $this->user_id
    }

   public function tweets()
    {
        return $this->hasMany(Tweet::class, 'user_id');
    }

    // In app/Models/User.php
public function likes()
{
    return $this->hasMany(Like::class, 'user_id');
}

    public function retweets()
    {
        // Same as above, ensuring correct local key reference
        return $this->hasMany(\App\Models\Retweet::class, 'user_id', 'user_id'); // FIX: Changed 'id' to 'user_id' for clarity/consistency
    }
}