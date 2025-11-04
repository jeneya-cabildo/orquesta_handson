@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-black mb-6 text-center">Edit Movie Review</h1>

<div class="max-w-2xl mx-auto bg-white p-8 border border-gray-300 rounded-lg shadow-md">
    <form action="{{ route('movies.update', $movie->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block font-semibold text-black mb-2">Movie Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $movie->title) }}"
                   class="w-full border border-gray-400 rounded-md p-3 text-black focus:outline-none focus:ring-2 focus:ring-black"
                   required maxlength="255">
        </div>

        <div>
            <label for="rating" class="block font-semibold text-black mb-2">Star Rating (1–5)</label>
            <select name="rating" id="rating"
                    class="w-full border border-gray-400 rounded-md p-3 text-black focus:outline-none focus:ring-2 focus:ring-black"
                    required>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $movie->rating == $i ? 'selected' : '' }}>
                        {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                    </option>
                @endfor
            </select>
        </div>

        <div>
            <label for="review" class="block font-semibold text-black mb-2">Review</label>
            <textarea name="review" id="review" rows="5"
                      class="w-full border border-gray-400 rounded-md p-3 text-black focus:outline-none focus:ring-2 focus:ring-black"
                      required>{{ old('review', $movie->review) }}</textarea>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('movies.index') }}"
               class="bg-gray-300 text-black px-4 py-2 rounded-md hover:bg-gray-400 transition">
               Cancel
            </a>
            <button type="submit"
                    class="bg-black text-white px-6 py-2 rounded-md hover:bg-gray-800 transition">
                Update Review
            </button>
        </div>
    </form>
</div>
@endsection
