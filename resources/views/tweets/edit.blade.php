<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Tweet</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('tweets.update', $tweet) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea id="edit-content" name="content" rows="4" maxlength="280" class="mt-1 block w-full border rounded p-2">{{ old('content', $tweet->content) }}</textarea>
                        <p id="edit-counter" class="text-xs text-gray-500 mt-1">{{ strlen(old('content', $tweet->content)) }} / 280</p>
                        @error('content') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                   <div class="flex items-center justify-between">
                    <a href="{{ route('tweets.index') }}" 
                    class="inline-flex items-center gap-2 px-3 py-1 h-8 rounded text-sm border bg-white border-red-300 text-red-600 hover:bg-red-50">
                        Cancel
                    </a>
                    <div class="flex items-center gap-2">
                        <button id="save-btn" type="submit" aria-label="Save changes" 
                            class="inline-flex items-center gap-2 px-3 py-1 h-8 rounded text-sm border bg-white border-blue-300 text-blue-600 hover:bg-blue-50">
                            Save
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script>
       const editContent = document.getElementById('edit-content');
    const editCounter = document.getElementById('edit-counter');

    if (editContent) {
        editContent.addEventListener('input', () => {
            editCounter.textContent = editContent.value.length + ' / 280';
        });
    }

            const checkChanged = () => {
                const changed = editContent.value !== original && editContent.value.trim().length > 0;
                if (changed) {
                    saveBtn.classList.remove('hidden');
                    saveBtn.disabled = false;
                    updateBtn.classList.add('hidden');
                } else {
                    saveBtn.classList.add('hidden');
                    saveBtn.disabled = true;
                    updateBtn.classList.remove('hidden');
                }
            };

            editContent.addEventListener('input', () => {
                editCounter.textContent = editContent.value.length + ' / 280';
                checkChanged();
            });

            // run once to set initial state
            checkChanged();
    </script>
</x-app-layout>
