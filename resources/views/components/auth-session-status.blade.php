@props(['status'])

@if ($status)
    <div role="status" aria-live="polite" {{ $attributes->merge(['class' => 'rounded-md bg-green-50 border-l-4 border-green-400 p-4']) }}>
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">{{ $status }}</p>
            </div>
        </div>
    </div>
@endif
