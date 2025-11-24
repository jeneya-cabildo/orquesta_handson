<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index(Request $request)
{
    // eager load user and recent edits (latest first), include counts
// ... in public function index(Request $request) {

    // eager load user and recent edits (latest first), include counts
    $tweets = Tweet::with([
        'user:user_id,name', // Only select the necessary columns including the primary key
        'edits' => function ($q) {
            $q->latest(); // load edits in descending order
        }
    ])
    ->withCount(['likes', 'retweets', 'edits']) // count related models
    ->latest() // order tweets by latest
    ->paginate(10);

return view('tweets.index', compact('tweets'));
// ...
    }


    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:280',
        ]);

        $request->user()->tweets()->create([
            'content' => $request->content,
        ]);

        return back();
    }

    /**
     * Show the form for editing the specified tweet.
     */
    public function edit(Request $request, Tweet $tweet)
    {
        $user = $request->user();

        $uid = $user?->getAuthIdentifier();

        if (! $user || $tweet->user_id !== $uid) {
            abort(403);
        }

        return view('tweets.edit', compact('tweet'));
    }

    /**
     * Update the specified tweet in storage.
     */
    public function update(Request $request, Tweet $tweet)
    {
        $user = $request->user();

        $uid = $user?->getAuthIdentifier();

        if (! $user || $tweet->user_id !== $uid) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|string|max:280',
        ]);

        // record edit history before updating
        $old = $tweet->content;
        $new = $request->input('content');

        if ($old !== $new) {
            \App\Models\TweetEdit::create([
                'tweet_id' => $tweet->id,
                'user_id' => $uid,
                'old_content' => $old,
                'new_content' => $new,
            ]);
        }

        $tweet->update([
            'content' => $new,
        ]);

        // flash the edit details so the UI can show old vs new for the edited tweet
        return redirect()->route('tweets.index')->with([
            'success' => 'Tweet updated.',
            'edited' => [
                'tweet_id' => $tweet->id,
                'old' => $old,
                'new' => $new,
            ],
        ]);
    }

    /**
     * Remove the specified tweet from storage.
     */
    public function destroy(Request $request, Tweet $tweet)
    {
        $user = $request->user();

        $uid = $user?->getAuthIdentifier();

        if (! $user || $tweet->user_id !== $uid) {
            abort(403);
        }

        $tweet->delete();

        return back()->with('success', 'Tweet deleted.');
    }

    public function like(Request $request, Tweet $tweet)
    {
        $user = $request->user();

        if (! $user) {
            // If the request is unauthenticated, redirect to login.
            return redirect()->route('login');
        }

        $uid = $user->getAuthIdentifier();

        $existing = $tweet->likes()->where('user_id', $uid)->first();

        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            $tweet->likes()->create(['user_id' => $uid]);
            $liked = true;
        }

        // Return JSON for AJAX requests, otherwise redirect back
        // Sync the integer `likes` column on the tweets table so the value
        // persists and reflects the total number of likes from the likes table.
        $likesCount = $tweet->likes()->count();
        // Avoid calling the `likes` relation property (method) as it would
        // return the relationship; set the attribute explicitly instead.
        $tweet->setAttribute('likes', $likesCount);
        $tweet->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'liked' => $liked,
                'likes_count' => $likesCount,
            ]);
        }

        return back();
    }

    public function retweet(Request $request, Tweet $tweet)
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        $uid = $user->getAuthIdentifier();

        $existing = $tweet->retweets()->where('user_id', $uid)->first();

        if ($existing) {
            $existing->delete();
            $retweeted = false;
        } else {
            $tweet->retweets()->create(['user_id' => $uid]);
            $retweeted = true;
        }

        // Recalculate total retweets from the retweets table and persist
        // to the integer `retweets` column on the tweets table.
        $retweetsCount = $tweet->retweets()->count();
        $tweet->setAttribute('retweets', $retweetsCount);
        $tweet->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'retweeted' => $retweeted,
                'retweets_count' => $retweetsCount,
            ]);
        }

        return back();
    }
}