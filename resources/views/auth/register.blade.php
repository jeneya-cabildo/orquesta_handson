<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold">Create a new account</h1>
        <p class="text-sm text-gray-500">Fill out the form to register</p>
    </div>

    <div class="w-full sm:max-w-md mx-auto">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full"
                        type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full"
                        type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full"
                        type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Register Button -->
                <div>
                    <x-primary-button
                        class="w-full flex justify-center text-center normal-case text-base py-2 bg-pink-500 hover:bg-pink-600 text-white">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <div class="text-center mt-4 text-sm text-gray-600">
            <span>Already registered?</span>
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 ms-1">Sign in</a>
        </div>
    </div>
</x-guest-layout>
