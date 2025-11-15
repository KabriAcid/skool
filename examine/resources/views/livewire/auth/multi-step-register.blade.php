<div class="min-h-screen flex items-center justify-center p-3 sm:p-4"
    x-data="{ step: @entangle('currentStep'), role: @entangle('accountType'), transitioning:false }"
    x-on:step-changed.window="transitioning=true; setTimeout(()=>transitioning=false,300)">
    <div class="w-full max-w-4xl">

        <!-- Main Card -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 shadow-strong border border-white/20 animate-fadeIn">

            <!-- Header -->
            <div class="text-center mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-spiritual-900 mb-2">Create Your Account</h1>
                <p class="text-sm sm:text-base text-spiritual-600">Join thousands of students preparing for success! 🎯</p>
            </div>

            <!-- Account Type Selection (Initial) -->
            @if(!$accountType)
            <div class="mb-8">
                <label class="block text-sm font-medium text-spiritual-700 mb-3 sm:mb-4">I am a:</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <button
                        wire:click="$set('accountType', 'student')"
                        @click="transitioning=true; setTimeout(()=>transitioning=false,300)"
                        class="p-4 sm:p-6 border-2 rounded-xl sm:rounded-2xl transition-all duration-300 border-spiritual-200 hover:border-primary-300 focus:outline-none">
                        <x-lucide-user class="w-8 h-8 sm:w-12 sm:h-12 mx-auto mb-2 sm:mb-3 text-primary-600" />
                        <h3 class="font-bold text-base sm:text-lg text-spiritual-900">Student</h3>
                        <p class="text-xs sm:text-sm text-spiritual-600 mt-1">Prepare for JAMB, WAEC & NECO</p>
                    </button>

                    <button
                        wire:click="$set('accountType', 'school_admin')"
                        @click="transitioning=true; setTimeout(()=>transitioning=false,300)"
                        class="p-4 sm:p-6 border-2 rounded-xl sm:rounded-2xl transition-all duration-300 border-spiritual-200 hover:border-primary-300 focus:outline-none">
                        <x-lucide-school class="w-8 h-8 sm:w-12 sm:h-12 mx-auto mb-2 sm:mb-3 text-secondary-600" />
                        <h3 class="font-bold text-base sm:text-lg text-spiritual-900">School Admin</h3>
                        <p class="text-xs sm:text-sm text-spiritual-600 mt-1">Manage students & assessments</p>
                    </button>
                </div>
            </div>
            @endif

            @if($accountType)
            <!-- Progress Indicator -->
            <div class="mb-6 sm:mb-8" x-show="role" x-transition.opacity>
                <!-- Desktop: Full Step Indicators -->
                <div class="hidden lg:flex items-center justify-between">
                    @for($i = 1; $i <= $totalSteps; $i++)
                        <div class="flex items-center {{ $i < $totalSteps ? 'flex-1' : '' }}">
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold transition-all duration-300
                                    {{ $currentStep > $i ? 'bg-success-600 text-white' : ($currentStep === $i ? 'bg-primary-600 text-white scale-110' : 'bg-spiritual-200 text-spiritual-600') }}">
                                @if($currentStep > $i)
                                <x-lucide-check class="w-5 h-5" />
                                @else
                                {{ $i }}
                                @endif
                            </div>
                            <span class="text-xs mt-2 text-spiritual-600 font-medium">
                                @if($accountType === 'student')
                                {{ ['Account', 'Security', 'Confirm'][$i - 1] }}
                                @else
                                {{ ['Admin Info', 'School Info', 'Address & Capacity', 'Security', 'Confirm'][$i - 1] }}
                                @endif
                            </span>
                        </div>
                        @if($i < $totalSteps)
                            <div class="flex-1 h-1 mx-4 rounded transition-all duration-300
                                    {{ $currentStep > $i ? 'bg-success-600' : 'bg-spiritual-200' }}">
                </div>
                @endif
            </div>
            @endfor
        </div>

        <!-- Mobile: Single Step Display -->
        <div class="lg:hidden" x-show="role" x-transition.opacity>
            <div class="flex flex-col items-center gap-2 mb-3">
                <span class="text-lg font-bold text-primary-600">Step {{ $currentStep }} of {{ $totalSteps }}</span>
                <span class="text-sm text-spiritual-600 font-medium">
                    @if($accountType === 'student')
                    {{ ['Account', 'Security', 'Confirm'][$currentStep - 1] }}
                    @else
                    {{ ['Admin Info', 'School Info', 'Address & Capacity', 'Security', 'Confirm'][$currentStep - 1] }}
                    @endif
                </span>
            </div>
            <div class="w-full h-2 bg-spiritual-200 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full transition-all duration-500"
                    style="width: {{ ($currentStep / $totalSteps) * 100 }}%"></div>
            </div>
        </div>
    </div>

    <!-- Form Steps -->
    <form wire:submit.prevent="{{ $currentStep === $totalSteps ? 'register' : 'nextStep' }}" class="space-y-4 sm:space-y-6">

        @if($accountType === 'student')
        <!-- Student Step 1: Account Info -->
        @if($currentStep === 1)
        <div class="space-y-4 sm:space-y-5" x-show="step===1" x-transition.opacity.scale.duration.300ms>
            <div>
                <div class="relative">
                    <x-lucide-user class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                    <input
                        type="text"
                        id="name"
                        wire:model.defer="name"
                        placeholder="Full Name"
                        class="input-field pl-10 text-sm sm:text-base"
                        required>
                </div>
                @error('name') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div>
                <div class="relative">
                    <x-lucide-mail class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                    <input
                        type="email"
                        id="email"
                        wire:model.defer="email"
                        placeholder="Email Address"
                        class="input-field pl-10 text-sm sm:text-base"
                        required>
                </div>
                @error('email') <span class="error-message">{{ $message }}</span> @enderror
            </div>
        </div>
        @endif

        <!-- Student Step 2: Security -->
        @if($currentStep === 2)
        <div class="space-y-4 sm:space-y-5" x-show="step===2" x-transition.opacity.scale.duration.300ms>
            <div>
                <div class="relative">
                    <x-lucide-lock class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                    <input
                        type="password"
                        id="password"
                        wire:model.defer="password"
                        placeholder="Password"
                        class="input-field pl-10 text-sm sm:text-base"
                        required>
                </div>
                <p class="text-xs text-spiritual-500 mt-1">Minimum 8 characters</p>
                @error('password') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div>
                <div class="relative">
                    <x-lucide-lock-keyhole class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                    <input
                        type="password"
                        id="password_confirmation"
                        wire:model.defer="password_confirmation"
                        placeholder="Confirm Password"
                        class="input-field pl-10 text-sm sm:text-base"
                        required>
                </div>
                @error('password_confirmation') <span class="error-message">{{ $message }}</span> @enderror
            </div>
        </div>
        @endif

        <!-- Student Step 3: Confirm -->
        @if($currentStep === 3)
        <div class="space-y-4 sm:space-y-6" x-show="step===3" x-transition.opacity.scale.duration.300ms>
            <div class="bg-primary-50 border border-primary-200 rounded-xl p-4 sm:p-6">
                <h3 class="font-bold text-base sm:text-lg text-spiritual-900 mb-3 sm:mb-4">📝 Review Your Information</h3>
                <div class="space-y-2 text-sm sm:text-base">
                    <p><span class="font-medium">Name:</span> {{ $name }}</p>
                    <p><span class="font-medium">Email:</span> {{ $email }}</p>
                </div>
            </div>

            <label class="flex items-start space-x-3 cursor-pointer">
                <input
                    type="checkbox"
                    wire:model.defer="agreeToTerms"
                    class="w-5 h-5 mt-0.5 text-primary-600 rounded focus:ring-primary-500">
                <span class="text-xs sm:text-sm text-spiritual-600">
                    I agree to the <a href="/terms" class="text-primary-600 hover:text-primary-700 underline">Terms & Conditions</a> and <a href="/privacy" class="text-primary-600 hover:text-primary-700 underline">Privacy Policy</a>
                </span>
            </label>
            @error('agreeToTerms') <span class="error-message">{{ $message }}</span> @enderror
        </div>
        @endif

        @else
        <!-- School Admin Forms -->
        <!-- Step 1: Admin Info -->
        @if($currentStep === 1)
        <div class="space-y-4 sm:space-y-5" x-show="step===1" x-transition.opacity.scale.duration.300ms>
            <div class="bg-secondary-50 border border-secondary-200 rounded-xl p-3 sm:p-4 mb-4">
                <p class="text-xs sm:text-sm text-spiritual-700">
                    <x-lucide-info class="w-4 h-4 inline mr-1" />
                    This will be your administrator account to manage students and exams.
                </p>
            </div>

            <div>
                <div class="relative">
                    <x-lucide-user class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                    <input
                        type="text"
                        id="adminName"
                        wire:model.defer="adminName"
                        placeholder="Administrator Full Name"
                        class="input-field pl-10 text-sm sm:text-base"
                        required>
                </div>
                @error('adminName') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div>
                <div class="relative">
                    <x-lucide-phone class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                    <input
                        type="tel"
                        id="adminPhone"
                        wire:model.defer="adminPhone"
                        placeholder="Administrator Phone Number"
                        class="input-field pl-10 text-sm sm:text-base"
                        required>
                </div>
                @error('adminPhone') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div>
                <div class="relative">
                    <x-lucide-mail class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                    <input
                        type="email"
                        id="adminEmail"
                        wire:model.defer="adminEmail"
                        placeholder="Administrator Email Address"
                        class="input-field pl-10 text-sm sm:text-base"
                        required>
                </div>
                @error('adminEmail') <span class="error-message">{{ $message }}</span> @enderror
            </div>
        </div>
        @endif

        <!-- Step 2: School Info -->
        @if($currentStep === 2)
        <div class="space-y-4 sm:space-y-5" x-show="step===2" x-transition.opacity.scale.duration.300ms>
            <div>
                <div class="relative">
                    <x-lucide-school class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                    <input
                        type="text"
                        id="schoolName"
                        wire:model.defer="schoolName"
                        placeholder="School Name"
                        class="input-field pl-10 text-sm sm:text-base"
                        required>
                </div>
                @error('schoolName') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div>
                <div class="relative">
                    <x-lucide-phone class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                    <input
                        type="tel"
                        id="schoolPhone"
                        wire:model.defer="schoolPhone"
                        placeholder="School Phone Number"
                        class="input-field pl-10 text-sm sm:text-base"
                        required>
                </div>
                @error('schoolPhone') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div>
                <div class="relative">
                    <x-lucide-mail class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                    <input
                        type="email"
                        id="schoolEmail"
                        wire:model.defer="schoolEmail"
                        placeholder="School Email Address"
                        class="input-field pl-10 text-sm sm:text-base"
                        required>
                </div>
                @error('schoolEmail') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div>
                <div class="relative">
                    <x-lucide-map-pin class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                    <select
                        id="schoolState"
                        wire:model.defer="schoolState"
                        class="input-field pl-10 text-sm sm:text-base"
                        required>
                        <option value="">Select State</option>
                        @foreach($states as $id => $name)
                        <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('schoolState') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div>
                <div class="relative">
                    <x-lucide-map class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                    <input
                        type="text"
                        id="schoolCity"
                        wire:model.defer="schoolCity"
                        placeholder="City/Town"
                        class="input-field pl-10 text-sm sm:text-base"
                        required>
                </div>
                @error('schoolCity') <span class="error-message">{{ $message }}</span> @enderror
            </div>
        </div>
        @endif

        <!-- Step 3: Address & Capacity -->
        @if($currentStep === 3)
        <div class="space-y-4 sm:space-y-5" x-show="step===3" x-transition.opacity.scale.duration.300ms>
            <div>
                <div class="relative">
                    <x-lucide-map-pinned class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                    <textarea
                        id="schoolAddress"
                        wire:model.defer="schoolAddress"
                        rows="3"
                        placeholder="Full School Address"
                        class="input-field pl-10 text-sm sm:text-base resize-none"
                        required></textarea>
                </div>
                @error('schoolAddress') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div>
                <div class="relative">
                    <x-lucide-users class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                    <input
                        type="number"
                        id="numberOfStudents"
                        wire:model.defer="numberOfStudents"
                        min="10"
                        max="10000"
                        placeholder="Number of Students"
                        class="input-field pl-10 text-sm sm:text-base"
                        required>
                </div>
                <p class="text-xs sm:text-sm text-spiritual-600 mt-2">
                    💰 Cost: <span class="font-bold text-primary-600">₦{{ number_format($numberOfStudents * 1000, 2) }}</span>
                    <span class="text-spiritual-500">(₦1,000 per student)</span>
                </p>
                @error('numberOfStudents') <span class="error-message">{{ $message }}</span> @enderror
            </div>
        </div>
        @endif

        <!-- Step 4: Security -->
        @if($currentStep === 4)
        <div class="space-y-4 sm:space-y-5" x-show="step===4" x-transition.opacity.scale.duration.300ms>
            <div>
                <div class="relative">
                    <x-lucide-lock class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                    <input
                        type="password"
                        id="adminPassword"
                        wire:model.defer="adminPassword"
                        placeholder="Password"
                        class="input-field pl-10 text-sm sm:text-base"
                        required>
                </div>
                <p class="text-xs text-spiritual-500 mt-1">Minimum 8 characters</p>
                @error('adminPassword') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div>
                <div class="relative">
                    <x-lucide-lock-keyhole class="absolute left-3 top-3.5 w-5 h-5 text-spiritual-400" />
                    <input
                        type="password"
                        id="adminPassword_confirmation"
                        wire:model.defer="adminPassword_confirmation"
                        placeholder="Confirm Password"
                        class="input-field pl-10 text-sm sm:text-base"
                        required>
                </div>
                @error('adminPassword_confirmation') <span class="error-message">{{ $message }}</span> @enderror
            </div>
        </div>
        @endif

        <!-- Step 5: Confirm & Payment Info -->
        @if($currentStep === 5)
        <div class="space-y-4 sm:space-y-6" x-show="step===5" x-transition.opacity.scale.duration.300ms>
            <div class="bg-primary-50 border border-primary-200 rounded-xl p-4 sm:p-6">
                <h3 class="font-bold text-base sm:text-lg text-spiritual-900 mb-3 sm:mb-4">📋 Registration Summary</h3>
                <div class="space-y-2 sm:space-y-3 text-xs sm:text-sm">
                    <div class="flex justify-between">
                        <span class="font-medium">School Name:</span>
                        <span class="text-right">{{ $schoolName }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">School Email:</span>
                        <span class="text-right">{{ $schoolEmail }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">School Phone:</span>
                        <span class="text-right">{{ $schoolPhone }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Location:</span>
                        <span class="text-right">{{ $schoolCity }}, {{ $schoolState }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Administrator:</span>
                        <span class="text-right">{{ $adminName }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Admin Phone:</span>
                        <span class="text-right">{{ $adminPhone }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-2 sm:pt-3 border-t border-primary-300">
                        <span class="font-bold">Students:</span>
                        <span class="font-bold text-primary-600">{{ number_format($numberOfStudents) }}</span>
                    </div>
                    <div class="flex justify-between items-center bg-warning-50 border border-warning-200 rounded-lg p-2 sm:p-3 mt-2 sm:mt-3">
                        <span class="font-bold">Total Amount:</span>
                        <span class="text-lg sm:text-xl font-bold text-warning-700">₦{{ number_format($numberOfStudents * 1000, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-secondary-50 border border-secondary-200 rounded-xl p-3 sm:p-4">
                <p class="text-xs sm:text-sm text-spiritual-700 leading-relaxed">
                    <x-lucide-alert-circle class="w-4 h-4 inline mr-1 text-secondary-600" />
                    After registration, you'll receive payment instructions via email. Your account will be activated within 24 hours of payment confirmation.
                </p>
            </div>

            <label class="flex items-start space-x-3 cursor-pointer">
                <input
                    type="checkbox"
                    wire:model.defer="agreeToTerms"
                    class="w-5 h-5 mt-0.5 text-primary-600 rounded focus:ring-primary-500">
                <span class="text-xs sm:text-sm text-spiritual-600">
                    I agree to the <a href="/terms" class="text-primary-600 hover:text-primary-700 underline">Terms & Conditions</a> and <a href="/privacy" class="text-primary-600 hover:text-primary-700 underline">Privacy Policy</a>
                </span>
            </label>
            @error('agreeToTerms') <span class="error-message">{{ $message }}</span> @enderror
        </div>
        @endif
        @endif

        <!-- Navigation Buttons -->
        <div class="flex items-center justify-between pt-4 sm:pt-6 border-t border-spiritual-200">
            @if($currentStep > 1)
            <button
                type="button"
                wire:click="previousStep"
                class="px-4 sm:px-6 py-2 sm:py-3 text-sm sm:text-base bg-spiritual-100 text-spiritual-700 font-medium rounded-xl hover:bg-spiritual-200 transition-all duration-300 inline-flex items-center">
                <x-lucide-arrow-left class="w-4 h-4 sm:w-5 sm:h-5 mr-2" />
                Back
            </button>
            @else
            <div></div>
            @endif

            @if($currentStep === $totalSteps)
            <button
                type="submit"
                class="px-6 sm:px-8 py-3 sm:py-3.5 text-sm sm:text-base bg-gradient-to-r from-primary-500 to-primary-600 text-white font-bold rounded-xl shadow-medium hover:shadow-strong transition-all duration-300 hover:scale-105 active:scale-95 inline-flex items-center">
                @if($accountType === 'student')
                <x-lucide-user-check class="w-4 h-4 sm:w-5 sm:h-5 mr-2" />
                Create Account
                @else
                <x-lucide-rocket class="w-4 h-4 sm:w-5 sm:h-5 mr-2" />
                Complete Registration
                @endif
            </button>
            @else
            <button
                type="submit"
                class="px-6 sm:px-8 py-3 sm:py-3.5 text-sm sm:text-base bg-gradient-to-r from-primary-500 to-primary-600 text-white font-medium rounded-xl shadow-medium hover:shadow-strong transition-all duration-300 hover:scale-105 active:scale-95 inline-flex items-center">
                Continue
                <x-lucide-arrow-right class="w-4 h-4 sm:w-5 sm:h-5 ml-2" />
            </button>
            @endif
        </div>
    </form>
    @endif

    <!-- Login Link -->
    <div class="text-center mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-spiritual-200">
        <p class="text-xs sm:text-sm text-spiritual-600">
            Already have an account?
            <a href="{{ route('login') }}" wire:navigate class="text-primary-600 hover:text-primary-700 font-semibold ml-1">Sign In</a>
        </p>
    </div>
</div>
</div>

<!-- Success Modal for School Admin -->
@if($showSuccessModal)
<div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm animate-fadeIn"
    x-data="{ show: true }"
    x-show="show"
    x-transition>
    <div class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 max-w-2xl w-full shadow-strong animate-fadeIn"
        @click.away="show = false">

        <!-- Success Animation -->
        <div class="text-center mb-6">
            <div class="flex justify-center mb-4">
                <lottie-player
                    src="https://lottie.host/d0837cee-ad08-4a62-9ff0-e4c1abef1fa3/QhDyxBCvHO.json"
                    background="transparent"
                    speed="1"
                    style="width: 200px; height: 200px;"
                    autoplay>
                </lottie-player>
            </div>
            <h2 class="text-2xl sm:text-3xl font-bold text-spiritual-900 mb-2">Registration Successful! 🎉</h2>
            <p class="text-sm sm:text-base text-spiritual-600">Your school account has been created</p>
        </div>

        <!-- Registration Details -->
        <div class="bg-primary-50 border border-primary-200 rounded-xl p-4 sm:p-6 mb-6">
            <h3 class="font-bold text-base sm:text-lg text-spiritual-900 mb-4">📧 What Happens Next?</h3>
            <div class="space-y-3 text-sm sm:text-base text-spiritual-700">
                <div class="flex items-start">
                    <span class="bg-primary-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0 mt-0.5">1</span>
                    <p>Check your email <strong>({{ $registrationData['admin_email'] ?? '' }})</strong> for payment instructions</p>
                </div>
                <div class="flex items-start">
                    <span class="bg-primary-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0 mt-0.5">2</span>
                    <p>Make payment of <strong class="text-warning-700">{{ $registrationData['formatted_amount'] ?? '' }}</strong> to the provided account</p>
                </div>
                <div class="flex items-start">
                    <span class="bg-primary-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0 mt-0.5">3</span>
                    <p>Your account will be activated within <strong>24 hours</strong> of payment confirmation</p>
                </div>
                <div class="flex items-start">
                    <span class="bg-primary-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0 mt-0.5">4</span>
                    <p>You'll receive an activation email with your dashboard access link</p>
                </div>
            </div>
        </div>

        <!-- Account Details -->
        <div class="bg-secondary-50 border border-secondary-200 rounded-xl p-4 sm:p-6 mb-6">
            <h4 class="font-bold text-sm sm:text-base text-spiritual-900 mb-3">Your School Details:</h4>
            <div class="space-y-2 text-xs sm:text-sm">
                <div class="flex justify-between">
                    <span class="text-spiritual-600">School Name:</span>
                    <span class="font-medium">{{ $registrationData['school_name'] ?? '' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-spiritual-600">School Code:</span>
                    <span class="font-mono font-bold text-primary-600">{{ $registrationData['school_code'] ?? '' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-spiritual-600">Student Capacity:</span>
                    <span class="font-medium">{{ number_format($registrationData['number_of_students'] ?? 0) }} students</span>
                </div>
            </div>
        </div>

        <!-- Action Button -->
        <a href="{{ route('welcome') }}" wire:navigate
            class="w-full bg-gradient-to-r from-primary-500 to-primary-600 text-white font-bold py-3 sm:py-4 px-6 rounded-xl shadow-medium hover:shadow-strong transition-all duration-300 hover:scale-105 active:scale-95 inline-flex items-center justify-center text-sm sm:text-base">
            <x-lucide-home class="w-5 h-5 mr-2" />
            Back to Home
        </a>

        <p class="text-center text-xs sm:text-sm text-spiritual-500 mt-4">
            Need help? Contact us at <a href="mailto:support@examine.ng" class="text-primary-600 hover:underline">support@examine.ng</a>
        </p>
    </div>
</div>
@endif
</div>