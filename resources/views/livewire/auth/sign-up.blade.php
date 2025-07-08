<div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-b from-purple-200 to-pink-400 p-4">
    <div class="w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-rose-800 mb-2">Create Your Account</h2>
            <p class="text-rose-500">Join our community today</p>
        </div>

        <!-- Form Container -->
        <form wire:submit.prevent="register"
            class="w-full bg-white p-8 rounded-xl shadow-lg border border-white/20 backdrop-blur-sm">
            <!-- Name Field -->
            <div class="mb-5">
                <label for="name" class="block text-sm font-medium text-rose-500 mb-2">Full Name</label>
                <div class="relative">
                    <input type="text" wire:model="name"
                        class="w-full px-4 py-3 text-sm border border-indigo-100 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 bg-white/70 text-indigo-800 placeholder-indigo-300 transition duration-200"
                        placeholder="John Doe">
                    @error('name')
                        <span class="absolute right-3 top-3 text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    @enderror
                </div>
                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-rose-500 mb-2">Email Address</label>
                <div class="relative">
                    <input type="email" wire:model="email"
                        class="w-full px-4 py-3 text-sm border border-indigo-100 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 bg-white/70 text-indigo-800 placeholder-indigo-300 transition duration-200"
                        placeholder="you@example.com">
                    @error('email')
                        <span class="absolute right-3 top-3 text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    @enderror
                </div>
                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-rose-500 mb-2">Password</label>
                <div class="relative">
                    <input type="password" wire:model="password"
                        class="w-full px-4 py-3 text-sm border border-indigo-100 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 bg-white/70 text-indigo-800 placeholder-indigo-300 transition duration-200"
                        placeholder="••••••••">
                    @error('password')
                        <span class="absolute right-3 top-3 text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    @enderror
                </div>
                @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Confirm Password Field -->
            <div class="mb-5">
                <label for="password_confirmation" class="block text-sm font-medium text-rose-500 mb-2">Confirm
                    Password</label>
                <input type="password" wire:model="password_confirmation"
                    class="w-full px-4 py-3 text-sm border border-indigo-100 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 bg-white/70 text-indigo-800 placeholder-indigo-300 transition duration-200"
                    placeholder="••••••••">
            </div>

            <!-- Role Dropdown -->
            <div class="mb-6">
                <label for="role" class="block text-sm font-medium text-rose-500 mb-2">Role</label>
                <div class="relative">
                    <select wire:model="role"
                        class="w-full px-4 py-3 text-sm border border-indigo-100 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 bg-white/70 text-indigo-800 appearance-none transition duration-200">
                        <option value="admin_consultant">Admin Consultant</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="h-5 w-5 text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                @error('role') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Certificate Upload Field -->
            <div class="mb-6">
                <label for="certificate" class="block text-sm font-medium text-rose-500 mb-2">Certificate (PDF)</label>
                <input type="file" wire:model.defer="certificate" accept="application/pdf"
                    class="w-full px-4 py-3 text-sm border border-indigo-100 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 bg-white/70 text-indigo-800 transition duration-200">
                @error('certificate') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-lg text-sm text-white bg-gradient-to-r from-rose-400 to-amber-400 hover:from-rose-500 hover:to-amber-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-300 transition-all duration-300">
                <span wire:loading.remove wire:target="register">
                    Create Account
                </span>
                <span wire:loading wire:target="register" class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Creating Account...
                </span>
            </button>

            <!-- Sign In Link -->
            <p class="mt-6 text-center text-sm text-rose-500">
                Already have an account?
                <a href="{{ route('sign-in') }}"
                    class="font-medium text-rose-800 hover:text-indigo-800 hover:underline ml-1">Sign In</a>
            </p>
        </form>
    </div>
</div>