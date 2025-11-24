<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold">Sign in to your account</h1>
        <p class="text-sm text-gray-500">Enter your credentials to access the app</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full sm:max-w-md mx-auto">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mb-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-800"
                           href="{{ route('password.request') }}">
                           {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div>
                    <x-primary-button
                        class="w-full flex justify-center text-center normal-case text-base py-2">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <div class="text-center mt-4 text-sm text-gray-600">
            <span>Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 ms-1">Create one</a>
        </div>
    </div>
</x-guest-layout>
