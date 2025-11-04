@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-black mb-6 text-center">Add New Movie</h1>

<form action="{{ route('movies.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded border border-gray-300">
    @csrf
    <label class="block mb-2 text-black">Title</label>
    <input type="text" name="title" class="w-full border border-gray-400 rounded px-3 py-2 text-black" required>

    <label class="block mt-4 mb-2 text-black">Genre</label>
    <select name="genre" class="w-full border border-gray-400 rounded px-3 py-2 text-black">
        <option value="">Select Genre</option>
        <option>Action</option>
        <option>Drama</option>
        <option>Comedy</option>
        <option>Romance</option>
        <option>Thriller</option>
    </select>

    <label class="block mt-4 mb-2 text-black">Release Year</label>
    <input type="number" name="release_year" class="w-full border border-gray-400 rounded px-3 py-2 text-black">

    <label class="block mt-4 mb-2 text-black">Poster URL</label>
    <input type="url" name="poster" class="w-full border border-gray-400 rounded px-3 py-2 text-black">

    <label class="block mt-4 mb-2 text-black">Rating (1–5)</label>
    <input type="number" name="rating" min="1" max="5" class="w-full border border-gray-400 rounded px-3 py-2 text-black" required>

    <label class="block mt-4 mb-2 text-black">Review</label>
    <textarea name="review" id="review" rows="4" class="w-full border border-gray-400 rounded px-3 py-2 text-black" maxlength="500" required></textarea>
    <p id="charCount" class="text-sm text-gray-600 text-right">0 / 500</p>

    <button type="submit" class="bg-black text-white px-6 py-2 mt-4 rounded hover:bg-gray-800 w-full">Save Movie</button>
</form>

<script>
const review = document.getElementById('review');
const charCount = document.getElementById('charCount');
review.addEventListener('input', () => {
    charCount.textContent = `${review.value.length} / 500`;
});
</script>
@endsection
