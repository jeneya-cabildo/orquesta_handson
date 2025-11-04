@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-black mb-6 text-center">{{ $movie->title }}</h1>

<div class="max-w-2xl mx-auto bg-white border border-gray-400 p-6 rounded-lg shadow-md">
    <p class="text-black mb-2"><strong>Rating:</strong>
        @for ($i = 1; $i <= 5; $i++)
            {!! $i <= $movie->rating ? '★' : '☆' !!}
        @endfor
    </p>
    <p class="text-black mb-4"><strong>Review:</strong> {{ $movie->review }}</p>
    <p class="text-black text-sm">Created: {{ $movie->created_at->format('M d, Y') }}</p>

    <div class="mt-6 flex justify-between">
        <a href="{{ route('movies.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400">Back</a>
        <a href="{{ route('movies.edit', $movie->id) }}" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">Edit</a>
    </div>
</div>
@endsection
