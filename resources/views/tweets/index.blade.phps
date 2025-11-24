<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Home</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- New Tweet Form -->
            @auth
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                    <form method="POST" action="{{ route('tweets.store') }}">
                        @csrf
                        <div>
                            <textarea id="new-content" name="content" rows="3" class="w-full border rounded p-2" placeholder="What's happening?" required maxlength="280">{{ old('content') }}</textarea>
                            <p id="new-counter" class="text-xs text-gray-500 mt-1">{{ strlen(old('content', '')) }} / 280</p>
                            @error('content') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="mt-2 text-right">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded">Tweet</button>
                        </div>
                    </form>
                </div>

                <script>
                    const newContent = document.getElementById('new-content');
                    const newCounter = document.getElementById('new-counter');
                    if (newContent) {
                        newContent.addEventListener('input', () => {
                            newCounter.textContent = newContent.value.length + ' / 280';
                        });
                    }
                </script>
            @endauth

            <!-- Tweet List -->
            <div class="space-y-4">
                @foreach($tweets as $tweet)
                    <div class="bg-white p-4 rounded shadow-sm">
                        <div class="flex items-start">
                            <div class="flex-1">
                                <!-- Tweet Author -->
                                @if($tweet->user)
                                    <div class="text-sm font-semibold">{{ $tweet->user->name }}</div>
                                @else
                                    <div class="text-sm font-semibold text-gray-400">Unknown User</div>
                                @endif

                                <!-- Tweet Content -->
                                <div class="text-sm text-gray-700">{{ $tweet->content }}</div>

                                <!-- Timestamp -->
                                <div class="text-xs text-gray-500 mt-2">
                                    {{ $tweet->created_at->diffForHumans() }}
                                    @if($tweet->updated_at && $tweet->updated_at->gt($tweet->created_at))
                                        <span class="text-xs text-gray-400">· edited</span>
                                    @endif
                                </div>

                                <!-- Edit/Delete Buttons (Left under tweet) -->
                                @auth
                                    @if(auth()->check() && auth()->id() === $tweet->user_id)
                                        <div class="flex items-center gap-2 mt-2">
                                            <a href="{{ route('tweets.edit', $tweet) }}"
                                               class="inline-flex items-center gap-2 px-3 py-1 h-8 rounded text-sm border bg-white border-blue-300 text-blue-600 hover:bg-blue-50">
                                                Edit
                                            </a>

                                            <form method="POST" action="{{ route('tweets.destroy', $tweet) }}" onsubmit="return confirm('Delete this tweet?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center gap-2 px-3 py-1 h-8 rounded text-sm border bg-white border-red-300 text-red-600 hover:bg-red-50">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>

                            <!-- Likes / Retweets (Right side) -->
                            <div class="ms-4 text-right">
                                <div class="flex flex-col items-end gap-2 mt-4">
                                    <div class="flex items-center gap-3">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 likes-badge">{{ $tweet->likes_count ?? 0 }} Likes</span>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 retweets-badge">{{ $tweet->retweets_count ?? 0 }} Retweets</span>
                                    </div>

                                    @auth
                                        <div class="flex items-center gap-2 mt-1">
                                            <!-- Like Button -->
                                            <form method="POST" action="{{ route('tweets.like', $tweet) }}" class="like-form" data-action="{{ route('tweets.like', $tweet) }}">
                                                @csrf
                                                <button type="submit" class="like-btn inline-flex items-center gap-2 px-3 py-1 h-8 rounded text-sm border bg-white hover:bg-blue-50" data-tweet-id="{{ $tweet->id }}" aria-pressed="{{ $tweet->isLikedBy(auth()->user()) ? 'true' : 'false' }}">
                                                    <span class="like-text">@if($tweet->isLikedBy(auth()->user())) Unlike @else Like @endif</span>
                                                </button>
                                            </form>

                                            <!-- Retweet Button -->
                                            <form method="POST" action="{{ route('tweets.retweet', $tweet) }}">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center gap-2 px-3 py-1 h-8 rounded text-sm border bg-white hover:bg-green-50">
                                                    <span class="retweet-text">@if($tweet->isRetweetedBy(auth()->user())) Undo @else Retweet @endif</span>
                                                </button>
                                            </form>
                                        </div>
                                    @endauth
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $tweets->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
