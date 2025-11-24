<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold text-blue-600">{{ $user->name }}</div>
                        <div class="text-sm text-gray-400 mt-1">
                            <!-- FIX: Added 'calendar-alt' icon class and removed the invalid empty class attribute -->
                            <i class="fas fa-calendar-alt mr-1"></i>Joined {{ $user->created_at->format('F j, Y') }}
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-700 mb-1">
                            <span class="font-medium text-blue-600">{{ $totalTweets }}</span> Tweets
                        </div>
                        <div class="text-sm text-gray-700">
                            <span class="font-medium text-pink-500">{{ $totalLikesReceived }}</span> Total likes received
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Navigation Tabs -->
            <div class="mt-6 bg-white shadow-sm sm:rounded-t-lg">
                <nav class="flex border-b">
                    <!-- Note: The 'border rounded' on the <a> tags within a flex-nav might look odd. 
                         I've kept the classes but usually, tabs are styled without individual borders. -->
                    <a href="{{ route('users.show', ['user' => $user, 'tab' => 'tweets']) }}" class="px-4 py-2 text-sm font-medium transition-colors duration-200 {{ $tab === 'tweets' ? 'bg-blue-100 text-blue-800 border-b-2 border-blue-600' : 'text-gray-500 hover:bg-blue-50' }} ">
                        Tweets ({{ $totalTweets }})
                    </a>
                    <a href="{{ route('users.show', ['user' => $user, 'tab' => 'likes']) }}" class="px-4 py-2 text-sm font-medium transition-colors duration-200 {{ $tab === 'likes' ? 'bg-red-100 text-red-600 border-b-2 border-red-600' : 'text-gray-500 hover:bg-red-50' }} ">
                        Likes ({{ $totalLikes }})
                    </a>
                    <a href="{{ route('users.show', ['user' => $user, 'tab' => 'retweets']) }}" class="px-4 py-2 text-sm font-medium transition-colors duration-200 {{ $tab === 'retweets' ? 'bg-gray-100 text-gray-800 border-b-2 border-gray-600' : 'text-gray-500 hover:bg-gray-50' }} ">
                        Retweets ({{ $totalRetweets }})
                    </a>
                </nav>
            </div>

            <!-- Tweets/Likes/Retweets List -->
            <div class="bg-white shadow-sm sm:rounded-b-lg p-6">
                @if($tab === 'tweets')
                    <h3 class="font-semibold mb-4">Tweets</h3>
                @elseif($tab === 'likes')
                    <h3 class="font-semibold mb-4">Liked Tweets</h3>
                @elseif($tab === 'retweets')
                    <h3 class="font-semibold mb-4">Retweets</h3>
                @endif

                @forelse($tweets as $tweet)
                    <div class="border-b py-3" id="tweet-{{ $tweet->id }}">
                        @if($tweet->user)
                            <div class="flex items-center text-sm text-gray-600 mb-1">
                                <span class="font-medium">{{ $tweet->user->name }}</span>
                                <span class="mx-1">·</span>
                                <span>{{ $tweet->created_at->diffForHumans() }}</span>
                                @if(isset($tweet->retweeted_at) && $tab === 'retweets')
                                    <span class="mx-1">·</span>
                                    <span class="text-gray-500">Retweeted {{ $tweet->retweeted_at->diffForHumans() }}</span>
                                @endif
                            </div>
                        @endif
                        <div class="text-sm text-gray-800">{{ $tweet->content }}</div>
                        <div class="flex items-center space-x-4 mt-2">
                            <!-- Like Button -->
                            @auth
                            <button 
                                onclick="toggleLike({{ $tweet->id }})"
                                class="flex items-center space-x-1 text-gray-500 hover:text-red-500 transition-colors {{ $tweet->isLikedBy(auth()->user()) ? 'text-red-500' : '' }}"
                                id="like-btn-{{ $tweet->id }}"
                            >
                                <svg 
                                    class="w-5 h-5" 
                                    fill="{{ $tweet->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}" 
                                    stroke="currentColor" 
                                    viewBox="0 0 24 24" 
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                <span id="like-count-{{ $tweet->id }}" class="text-sm">
                                    {{ $tweet->likes_count ?? $tweet->likes()->count() ?? 0 }}
                                </span>
                            </button>
                            @endauth
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">
                        @if($tab === 'tweets')
                            No tweets yet.
                        @elseif($tab === 'likes')
                            No liked tweets yet.
                        @elseif($tab === 'retweets')
                            No retweets yet.
                        @endif
                    </p>
                @endforelse

                <div class="mt-4">{{ $tweets->appends(['tab' => $tab])->links() }}</div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function toggleLike(tweetId) {
                fetch(`/tweets/${tweetId}/like`, { 
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        // Throw an error if the HTTP status is not OK (e.g., 401, 500)
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const likeBtn = document.getElementById(`like-btn-${tweetId}`);
                    const likeCount = document.getElementById(`like-count-${tweetId}`);
                    
                    // Update like count
                    likeCount.textContent = data.likes_count;
                    
                    // Toggle like button appearance
                    const svg = likeBtn.querySelector('svg');
                    if (data.liked) {
                        svg.setAttribute('fill', 'currentColor');
                        likeBtn.classList.add('text-red-500');
                    } else {
                        svg.setAttribute('fill', 'none');
                        likeBtn.classList.remove('text-red-500');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        </script>
    @endpush
</x-app-layout>