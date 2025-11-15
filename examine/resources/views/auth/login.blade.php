<x-guest-layout>
    <x-slot name="title">Sign In - Examine CBT</x-slot>

    <div class="flex items-center justify-center p-4 min-h-screen">
        <div class="w-full max-w-md">
            <!-- Card -->
            <div
                x-data="{ show: false }"
                x-init="setTimeout(() => show = true, 200)"
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-5"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="card">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-spiritual-900 mb-2">Sign In</h1>
                    <p class="text-spiritual-600">Welcome back you've been missed</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" x-data="{ loading: false }" @submit="loading = true" class="space-y-6">
                    @csrf

                    <!-- Error Alert -->
                    @if ($errors->any())
                    <div class="p-3 bg-error-50 border border-error-200 rounded-xl text-error-600 text-sm">
                        @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-spiritual-700 mb-2">
                            Email ID
                        </label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Enter Email ID"
                            class="input-field @error('email') border-error-500 focus:border-error-500 focus:ring-error-500/20 @enderror" />
                        @error('email')
                        <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div x-data="{ showPassword: false }">
                        <label for="password" class="block text-sm font-medium text-spiritual-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <input
                                id="password"
                                :type="showPassword ? 'text' : 'password'"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Enter Password"
                                class="input-field @error('password') border-error-500 focus:border-error-500 focus:ring-error-500/20 @enderror ${showPasswordToggle ? 'pr-12' : ''}" />
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-spiritual-400 hover:text-spiritual-600">
                                <x-lucide-eye x-show="!showPassword" class="w-5 h-5" />
                                <x-lucide-eye-off x-show="showPassword" x-cloak class="w-5 h-5" />
                            </button>
                        </div>
                        @error('password')
                        <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2">
                            <input
                                type="checkbox"
                                name="remember"
                                class="w-4 h-4 text-primary-600 border-spiritual-300 rounded focus:ring-primary-500" />
                            <span class="text-sm text-spiritual-600">Remember Me</span>
                        </label>
                        <a href="/forgot-password" class="text-sm text-primary-600 hover:text-primary-700">
                            Forgot Password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="btn-primary w-full"
                        :disabled="loading">
                        <svg x-show="loading" x-cloak class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span x-text="loading ? 'Signing In...' : 'Sign In'"></span>
                    </button>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-spiritual-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-spiritual-500">Or with</span>
                        </div>
                    </div>

                    <!-- Sign Up Link -->
                    <div class="text-center">
                        <span class="text-spiritual-600">Don't have an account? </span>
                        <a href="{{ route('register') }}" class="text-primary-600 hover:text-primary-700 font-medium">
                            Sign Up
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>