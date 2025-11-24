<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold text-blue-600">{{ $user->name }}</div>
                        <div class="text-sm text-gray-400 mt-1">
                            <i class=></i>Joined {{ $user->created_at->format('F j, Y') }}
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
                    <a href="{{ route('users.show', ['user' => $user, 'tab' => 'tweets']) }}" class="px-4 py-2 text-sm font-medium transition-colors duration-200 {{ $tab === 'tweets' ? 'bg-blue-100 text-blue-800' : 'text-gray-500 hover:bg-blue-100' }} border rounded">
                        Tweets ({{ $totalTweets }})
                    </a>
                    <a href="{{ route('users.show', ['user' => $user, 'tab' => 'likes']) }}" class="px-4 py-2 text-sm font-medium transition-colors duration-200 {{ $tab === 'likes' ? 'bg-red-100 text-red-600' : 'text-gray-500 hover:bg-red-100' }} border rounded">
                        Likes ({{ $totalLikes }})
                    </a>
                    <a href="{{ route('users.show', ['user' => $user, 'tab' => 'retweets']) }}" class="px-4 py-2 text-sm font-medium transition-colors duration-200 {{ $tab === 'retweets' ? 'bg-gray-100 text-gray-800' : 'text-gray-500 hover:bg-gray-100' }} border rounded">
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
                    <div class="border-b py-3">
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
                        <div class="flex items-center mt-1 text-xs text-gray-500">
                            <span class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                @if(isset($tweet->likes_count))
                                    {{ $tweet->likes_count }}
                                @elseif(isset($tweet->likes) && is_object($tweet->likes) && method_exists($tweet->likes, 'count'))
                                    {{ $tweet->likes->count() }}
                                @else
                                    0
                                @endif
                            </span>
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
</x-app-layout>