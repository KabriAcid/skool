<x-guest-layout>
    <x-slot name="title">Sign Up - Examine CBT</x-slot>

    <div class="flex items-center justify-center p-4 min-h-screen">
        <div class="w-full max-w-2xl">

            <!-- Card -->
            <div
                x-data="{
                    accountType: null,
                    loading: false,
                    agreeToTerms: false,
                    showPassword: false,
                    showConfirmPassword: false,
                    selectAccount(type) {
                        this.accountType = type;
                    }
                }"
                x-init="
                    const urlParams = new URLSearchParams(window.location.search);
                    const role = urlParams.get('role');
                    if (role === 'student' || role === 'admin') {
                        accountType = role;
                    }
                "
                class="card">

                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold text-spiritual-900 mb-2">
                        {{ 'Create Your Account' }}
                    </h1>
                    <p class="text-spiritual-600 text-sm sm:text-base">
                        <span x-show="!accountType">Choose how you want to join</span>
                        <span x-show="accountType === 'student'">Student Registration - Free Trial</span>
                        <span x-show="accountType === 'admin'">School Admin Registration - Premium</span>
                    </p>
                </div>

                <!-- Account Type Selection -->
                <div x-show="!accountType" x-transition class="mb-8 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Student Button -->
                        <button
                            type="button"
                            @click="selectAccount('student')"
                            class="p-6 border-2 border-spiritual-200 rounded-2xl hover:border-primary-300 hover:bg-primary-50 transition-all duration-300 text-left group focus:outline-none">
                            <div class="flex items-start justify-between mb-3">
                                <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center group-hover:bg-primary-200 transition-colors">
                                    <x-lucide-user class="w-6 h-6 text-primary-600" />
                                </div>
                                <span class="px-3 py-1 bg-success-100 text-success-700 rounded-full text-xs font-semibold">FREE</span>
                            </div>
                            <h3 class="font-bold text-lg text-spiritual-900 mb-1">Student</h3>
                            <p class="text-sm text-spiritual-600">Start your free trial with basic features. Perfect for exam prep.</p>
                        </button>

                        <!-- Admin Button -->
                        <button
                            type="button"
                            @click="selectAccount('admin')"
                            class="p-6 border-2 border-spiritual-200 rounded-2xl hover:border-secondary-300 hover:bg-secondary-50 transition-all duration-300 text-left group focus:outline-none">
                            <div class="flex items-start justify-between mb-3">
                                <div class="w-12 h-12 bg-secondary-100 rounded-lg flex items-center justify-center group-hover:bg-secondary-200 transition-colors">
                                    <x-lucide-school class="w-6 h-6 text-secondary-600" />
                                </div>
                                <span class="px-3 py-1 bg-warning-100 text-warning-700 rounded-full text-xs font-semibold">PREMIUM</span>
                            </div>
                            <h3 class="font-bold text-lg text-spiritual-900 mb-1">School Admin</h3>
                            <p class="text-sm text-spiritual-600">Manage students & assessments. Full platform access.</p>
                        </button>
                    </div>
                </div>

                <!-- Form Section -->
                <form method="POST" action="{{ route('register') }}" @submit="loading = true" class="space-y-6" x-show="accountType">

                    <!-- Error Alert -->
                    @if ($errors->any())
                    <div class="p-3 bg-error-50 border border-error-200 rounded-xl text-error-600 text-sm">
                        @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    @csrf
                    <input type="hidden" name="account_type" :value="accountType">

                    <!-- STUDENT FORM -->
                    <div x-show="accountType === 'student'" x-transition class="space-y-5">

                        <!-- Full Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-spiritual-700 mb-2">Full Name</label>
                            <div class="relative">
                                <x-lucide-user class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="John Doe"
                                    required
                                    x-show="accountType === 'student'"
                                    class="input-field pl-10 @error('name') border-error-500 @enderror" />
                            </div>
                            @error('name')
                            <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email_student" class="block text-sm font-medium text-spiritual-700 mb-2">Email Address</label>
                            <div class="relative">
                                <x-lucide-mail class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                                <input
                                    id="email_student"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="you@example.com"
                                    required
                                    x-show="accountType === 'student'"
                                    class="input-field pl-10 @error('email') border-error-500 @enderror" />
                            </div>
                            @error('email')
                            <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password_student" class="block text-sm font-medium text-spiritual-700 mb-2">Password</label>
                            <div class="relative">
                                <x-lucide-lock class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                                <input
                                    id="password_student"
                                    :type="showPassword ? 'text' : 'password'"
                                    name="password"
                                    placeholder="••••••••"
                                    required
                                    x-show="accountType === 'student'"
                                    class="input-field pl-10 pr-12 @error('password') border-error-500 @enderror" />
                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-spiritual-400 hover:text-spiritual-600">
                                    <x-lucide-eye x-show="!showPassword" class="w-5 h-5" />
                                    <x-lucide-eye-off x-show="showPassword" x-cloak class="w-5 h-5" />
                                </button>
                            </div>
                            <p class="text-xs text-spiritual-500 mt-1">Minimum 8 characters</p>
                            @error('password')
                            <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation_student" class="block text-sm font-medium text-spiritual-700 mb-2">Confirm Password</label>
                            <div class="relative">
                                <x-lucide-lock class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                                <input
                                    id="password_confirmation_student"
                                    :type="showConfirmPassword ? 'text' : 'password'"
                                    name="password_confirmation"
                                    placeholder="••••••••"
                                    required
                                    x-show="accountType === 'student'"
                                    class="input-field pl-10 pr-12 @error('password_confirmation') border-error-500 @enderror" />
                                <button
                                    type="button"
                                    @click="showConfirmPassword = !showConfirmPassword"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-spiritual-400 hover:text-spiritual-600">
                                    <x-lucide-eye x-show="!showConfirmPassword" class="w-5 h-5" />
                                    <x-lucide-eye-off x-show="showConfirmPassword" x-cloak class="w-5 h-5" />
                                </button>
                            </div>
                            @error('password_confirmation')
                            <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- ADMIN FORM -->
                    <div x-show="accountType === 'admin'" x-transition class="space-y-5">

                        <!-- Admin Name -->
                        <div>
                            <label for="admin_name" class="block text-sm font-medium text-spiritual-700 mb-2">Administrator Name</label>
                            <div class="relative">
                                <x-lucide-user class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                                <input
                                    id="admin_name"
                                    type="text"
                                    name="admin_name"
                                    value="{{ old('admin_name') }}"
                                    placeholder="John Smith"
                                    required
                                    x-show="accountType === 'admin'"
                                    class="input-field pl-10 @error('admin_name') border-error-500 @enderror" />
                            </div>
                            @error('admin_name')
                            <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Admin Phone -->
                        <div>
                            <label for="admin_phone" class="block text-sm font-medium text-spiritual-700 mb-2">Phone Number</label>
                            <div class="relative">
                                <x-lucide-phone class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                                <input
                                    id="admin_phone"
                                    type="tel"
                                    name="admin_phone"
                                    value="{{ old('admin_phone') }}"
                                    placeholder="+234 800 000 0000"
                                    required
                                    x-show="accountType === 'admin'"
                                    class="input-field pl-10 @error('admin_phone') border-error-500 @enderror" />
                            </div>
                            @error('admin_phone')
                            <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- School Name -->
                        <div>
                            <label for="school_name" class="block text-sm font-medium text-spiritual-700 mb-2">School Name</label>
                            <div class="relative">
                                <x-lucide-school class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                                <input
                                    id="school_name"
                                    type="text"
                                    name="school_name"
                                    value="{{ old('school_name') }}"
                                    placeholder="Greenwood High School"
                                    required
                                    x-show="accountType === 'admin'"
                                    class="input-field pl-10 @error('school_name') border-error-500 @enderror" />
                            </div>
                            @error('school_name')
                            <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- School Email -->
                        <div>
                            <label for="school_email" class="block text-sm font-medium text-spiritual-700 mb-2">School Email</label>
                            <div class="relative">
                                <x-lucide-mail class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                                <input
                                    id="school_email"
                                    type="email"
                                    name="school_email"
                                    value="{{ old('school_email') }}"
                                    placeholder="info@greenwood.edu"
                                    required
                                    x-show="accountType === 'admin'"
                                    class="input-field pl-10 @error('school_email') border-error-500 @enderror" />
                            </div>
                            @error('school_email')
                            <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- School Phone -->
                        <div>
                            <label for="school_phone" class="block text-sm font-medium text-spiritual-700 mb-2">School Phone</label>
                            <div class="relative">
                                <x-lucide-phone class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                                <input
                                    id="school_phone"
                                    type="tel"
                                    name="school_phone"
                                    value="{{ old('school_phone') }}"
                                    placeholder="+234 800 000 0000"
                                    required
                                    x-show="accountType === 'admin'"
                                    class="input-field pl-10 @error('school_phone') border-error-500 @enderror" />
                            </div>
                            @error('school_phone')
                            <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Admin Email -->
                        <div>
                            <label for="email_admin" class="block text-sm font-medium text-spiritual-700 mb-2">Your Email Address</label>
                            <div class="relative">
                                <x-lucide-mail class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                                <input
                                    id="email_admin"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="you@greenwood.edu"
                                    required
                                    x-show="accountType === 'admin'"
                                    class="input-field pl-10 @error('email') border-error-500 @enderror" />
                            </div>
                            @error('email')
                            <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password_admin" class="block text-sm font-medium text-spiritual-700 mb-2">Password</label>
                            <div class="relative">
                                <x-lucide-lock class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                                <input
                                    id="password_admin"
                                    :type="showPassword ? 'text' : 'password'"
                                    name="password"
                                    placeholder="••••••••"
                                    required
                                    x-show="accountType === 'admin'"
                                    class="input-field pl-10 pr-12 @error('password') border-error-500 @enderror" />
                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-spiritual-400 hover:text-spiritual-600">
                                    <x-lucide-eye x-show="!showPassword" class="w-5 h-5" />
                                    <x-lucide-eye-off x-show="showPassword" x-cloak class="w-5 h-5" />
                                </button>
                            </div>
                            <p class="text-xs text-spiritual-500 mt-1">Minimum 8 characters</p>
                            @error('password')
                            <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation_admin" class="block text-sm font-medium text-spiritual-700 mb-2">Confirm Password</label>
                            <div class="relative">
                                <x-lucide-lock class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                                <input
                                    id="password_confirmation_admin"
                                    :type="showConfirmPassword ? 'text' : 'password'"
                                    name="password_confirmation"
                                    placeholder="••••••••"
                                    required
                                    x-show="accountType === 'admin'"
                                    class="input-field pl-10 pr-12 @error('password_confirmation') border-error-500 @enderror" />
                                <button
                                    type="button"
                                    @click="showConfirmPassword = !showConfirmPassword"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-spiritual-400 hover:text-spiritual-600">
                                    <x-lucide-eye x-show="!showConfirmPassword" class="w-5 h-5" />
                                    <x-lucide-eye-off x-show="showConfirmPassword" x-cloak class="w-5 h-5" />
                                </button>
                            </div>
                            @error('password_confirmation')
                            <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Terms and Conditions -->
                    <div x-show="accountType" x-transition class="space-y-2">
                        <label class="flex items-start space-x-3 cursor-pointer">
                            <input
                                type="checkbox"
                                name="agreeToTerms"
                                x-model="agreeToTerms"
                                class="w-4 h-4 text-primary-600 border-spiritual-300 rounded focus:ring-primary-500 mt-0.5" />
                            <span class="text-sm text-spiritual-600 leading-relaxed">
                                I Agree With The <a href="/terms" class="text-primary-600 hover:text-primary-700 underline">Terms And Conditions</a>
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div x-show="accountType" x-transition class="flex gap-3">
                        <button
                            type="button"
                            @click="accountType = null"
                            class="flex-1 bg-spiritual-100 text-spiritual-700 font-medium py-3 px-6 rounded-xl hover:bg-spiritual-200 transition-all duration-300 inline-flex items-center justify-center focus:outline-none">
                            <x-lucide-arrow-left class="w-5 h-5 mr-2" />
                            Back
                        </button>

                        <button
                            type="submit"
                            class="flex-1 btn-primary"
                            :disabled="loading || !agreeToTerms">
                            <svg x-show="loading" x-cloak class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span x-text="loading ? 'Creating Account...' : (accountType === 'student' ? 'Start Free Trial' : 'Register School')"></span>
                        </button>
                    </div>

                    <!-- Sign In Link -->
                    <div class="text-center" x-show="accountType" x-transition>
                        <span class="text-spiritual-600 text-sm">Already have an account? </span>
                        <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-700 font-medium">Sign In</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-guest-layout>