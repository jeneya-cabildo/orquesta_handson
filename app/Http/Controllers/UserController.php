<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Like;
use App\Models\Retweet;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a user's public profile.
     */
    public function show(Request $request, User $user)
    {
        $tab = $request->get('tab', 'tweets');
        
        switch ($tab) {
            case 'likes':
                $tweets = $user->likes()->with(['tweet.user', 'tweet.likes'])->paginate(10);
                $tweets->getCollection()->transform(function($like) {
                    return $like->tweet;
                });
                break;
                
            case 'retweets':
                $tweets = $user->retweets()->with(['tweet.user', 'tweet.likes'])->latest()->paginate(10);
                $tweets->getCollection()->transform(function($retweet) {
                    $tweet = $retweet->tweet;
                    $tweet->retweeted_at = $retweet->created_at;
                    return $tweet;
                });
                break;
                
            case 'tweets':
            default:
                $tweets = $user->tweets()->withCount('likes')->latest()->paginate(10);
                break;
        }

        // totals
        $totalTweets = $user->tweets()->count();
        $totalLikes = $user->likes()->count();
        $totalRetweets = $user->retweets()->count();
        
        $tweetIds = $user->tweets()->pluck('id');
        $totalLikesReceived = Like::whereIn('tweet_id', $tweetIds)->count();

        return view('users.show', compact(
            'user', 
            'tweets', 
            'totalTweets', 
            'totalLikes',
            'totalRetweets',
            'totalLikesReceived',
            'tab'
        ));
    }
}
