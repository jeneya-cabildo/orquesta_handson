@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
    '3xl' => 'sm:max-w-3xl',
    '4xl' => 'sm:max-w-4xl',
    '5xl' => 'sm:max-w-5xl',
    '6xl' => 'sm:max-w-6xl',
    '7xl' => 'sm:max-w-7xl',
    'full' => 'sm:max-w-full',
][$maxWidth];
@endphp

<div
    x-data="{
        show: @js($show),
        
        // Get all focusable elements within the modal
        getFocusables() {
            const selector = 'a[href], button, input, textarea, select, details, [tabindex]:not([tabindex=\'-1\'])';
            return [...$el.querySelectorAll(selector)]
                .filter(el => !el.hasAttribute('disabled') && !el.getAttribute('aria-hidden'))
                .filter(el => {
                    // Filter out elements that are hidden or have hidden parents
                    let parent = el;
                    while (parent) {
                        if (parent.style.display === 'none' || 
                            parent.style.visibility === 'hidden' || 
                            parent.hasAttribute('hidden')) {
                            return false;
                        }
                        parent = parent.parentElement;
                    }
                    return true;
                });
        },
        
        // Focus management
        firstFocusable() { 
            return this.getFocusables()[0]; 
        },
        lastFocusable() { 
            const focusables = this.getFocusables();
            return focusables[focusables.length - 1]; 
        },
        nextFocusable() { 
            const focusables = this.getFocusables();
            const currentIndex = focusables.indexOf(document.activeElement);
            return focusables[currentIndex + 1] || this.firstFocusable();
        },
        prevFocusable() { 
            const focusables = this.getFocusables();
            const currentIndex = focusables.indexOf(document.activeElement);
            return focusables[currentIndex - 1] || this.lastFocusable();
        },
        
        // Handle keyboard navigation
        handleKeydown(event) {
            if (event.key === 'Escape') {
                this.show = false;
                return;
            }
            
            if (event.key === 'Tab') {
                event.preventDefault();
                if (event.shiftKey) {
                    this.prevFocusable()?.focus();
                } else {
                    this.nextFocusable()?.focus();
                }
            }
        },
        
        // Handle outside click
        handleClickOutside(event) {
            if (event.target === $el) {
                this.show = false;
            }
        },
        
        // Initialize modal
        init() {
            // Close when clicking outside
            this.$watch('show', value => {
                if (value) {
                    document.body.classList.add('overflow-hidden');
                    this.$nextTick(() => {
                        // Focus first focusable element
                        const firstFocusable = this.firstFocusable();
                        if (firstFocusable) {
                            setTimeout(() => firstFocusable.focus(), 100);
                        }
                    });
                } else {
                    document.body.classList.remove('overflow-hidden');
                }
            });
            
            // Handle initial state
            if (this.show) {
                document.body.classList.add('overflow-hidden');
            }
            
            // Cleanup on component destroy
            this.$el._cleanup = () => {
                document.body.classList.remove('overflow-hidden');
            };
        }
    }"
    x-init="init()"
    x-on:keydown.window="handleKeydown"
    x-on:click.self="handleClickOutside"
    x-on:open-modal.window="$event.detail === '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail === '{{ $name }}' ? show = false : null"
    x-show="show"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: {{ $show ? 'block' : 'none' }};"
    x-cloak
>
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
         x-show="show"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         aria-hidden="true">
    </div>

    <!-- Modal container -->
    <div class="flex min-h-screen items-center justify-center p-4 sm:p-6">
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <!-- Modal panel -->
                <div
                    x-show="show"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 w-full {{ $maxWidth }}"
                    role="dialog"
                    aria-modal="true"
                    aria-labelledby="modal-title"
                >
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush