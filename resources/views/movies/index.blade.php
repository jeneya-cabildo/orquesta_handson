@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-8 bg-white rounded-lg shadow-md text-black">

    <h1 class="text-3xl font-bold mb-6 text-center"> Movie Reviews</h1>

    {{-- Filters --}}
    <form method="GET" action="{{ route('movies.index') }}" class="flex flex-wrap justify-center gap-3 mb-8">
        <input type="text" name="search" placeholder="Search by title" value="{{ request('search') }}"
               class="border border-gray-400 rounded px-3 py-2 text-black w-60 focus:outline-none focus:ring-2 focus:ring-gray-500">
        <select name="genre" class="border border-gray-400 rounded px-3 py-2 text-black focus:outline-none focus:ring-2 focus:ring-gray-500">
            <option value="">All Genres</option>
            @foreach($genres as $genre)
                <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>
                    {{ ucfirst($genre) }}
                </option>
            @endforeach
        </select>
        <select name="sort" class="border border-gray-400 rounded px-3 py-2 text-black focus:outline-none focus:ring-2 focus:ring-gray-500">
            <option value="">Sort By</option>
            <option value="newest">Newest</option>
            <option value="oldest">Oldest</option>
            <option value="highest">Highest Rated</option>
            <option value="lowest">Lowest Rated</option>
        </select>
        <button class="border border-black text-black px-4 py-2 rounded hover:bg-gray-100">Filter</button>
    </form>

    {{-- Movies Table --}}
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-400 table-fixed text-black">
            <thead class="bg-gray-100 border-b border-gray-300">
                <tr>
                    <th class="px-4 py-3 w-[10%] text-left">Poster</th>
                    <th class="px-4 py-3 w-[20%] text-left">Title</th>
                    <th class="px-4 py-3 w-[10%] text-left">Genre</th>
                    <th class="px-4 py-3 w-[10%] text-left">Rating</th>
                    <th class="px-4 py-3 w-[30%] text-left">Review</th>
                    <th class="px-4 py-3 w-[10%] text-left">Year</th>
                    <th class="px-4 py-3 w-[10%] text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($movies as $movie)
                <tr class="border-b hover:bg-gray-50 align-top">
                    <td class="px-4 py-3">
    @if($movie->poster)
        <img src="{{ $movie->poster }}" class="w-16 h-24 object-cover rounded border border-gray-300">
    @else
        <span class="text-gray-600">N/A</span>
    @endif
</td>

<td class="px-4 py-3 font-semibold break-words">{{ $movie->title }}</td>

<td class="px-4 py-3 break-words">{{ $movie->genre ?? '—' }}</td>

<td class="px-4 py-3">
    @for ($i = 1; $i <= 5; $i++)
        @if ($i <= $movie->rating)
            <span class="text-yellow-400">★</span>
        @else
            <span class="text-gray-300">★</span>
        @endif
    @endfor
</td>


<td class="px-4 py-3 break-words">{{ Str::limit($movie->review, 100) }}</td>

<td class="px-4 py-3">{{ $movie->release_year ?? '—' }}</td>

<td class="px-4 py-3 text-center space-y-2">

    {{-- Pastel View Button --}}
    <a href="{{ route('movies.show', $movie->id) }}" 
       class="border border-blue-300 text-blue-700 bg-blue-100 px-3 py-1 rounded block hover:bg-blue-200 transition">
        View
    </a>

    {{-- Pastel Edit Button --}}
    <a href="{{ route('movies.edit', $movie->id) }}" 
       class="border border-green-300 text-green-700 bg-green-100 px-3 py-1 rounded block hover:bg-green-200 transition">
        Edit
    </a>

    {{-- Pastel Delete Button --}}
    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST"
          onsubmit="return confirm('Delete this movie?')">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="border border-red-300 text-red-700 bg-red-100 px-3 py-1 rounded w-full hover:bg-red-200 transition">
            Delete
        </button>
    </form>

</td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-600">No movies found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Add Movie Button --}}
    <div class="mt-8 text-center">
        <a href="{{ route('movies.create') }}" 
           class="border border-black text-black px-6 py-2 rounded hover:bg-gray-100">+ Add New Movie</a>
    </div>

</div>
@endsection
