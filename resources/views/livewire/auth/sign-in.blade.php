<div class="flex flex-col justify-center items-center bg-gradient-to-b from-purple-200 to-pink-400 overflow-hidden">
    <div class="w-full max-w-md mx-auto">
        {{-- Logo/Header --}}
        <div class="text-center">
            <div class="mx-auto w-26 h-26">
                <img src="{{ asset('images/skin-savvy-logo.png') }}" alt="Skin Savvy Logo"
                    class="w-full h-full object-contain">
            </div>
        </div>

        {{-- Success & Error Messages --}}
        @if (session()->has('message'))
            <div
                class="mb-4 p-3 bg-emerald-50/80 text-emerald-700 rounded-lg border border-emerald-200 shadow-sm backdrop-blur-sm text-sm">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ session('message') }}
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div
                class="mb-4 p-3 bg-rose-50/80 text-rose-700 rounded-lg border border-rose-200 shadow-sm backdrop-blur-sm text-sm">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        {{-- Sign In Form --}}
        <form wire:submit.prevent="login"
            class="w-full bg-white/90 p-4 rounded-2xl shadow-lg border border-white backdrop-blur-sm">
            <div class="space-y-4">
                {{-- Email Field --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-rose-900/80 mb-1">Email Address</label>
                    <div class="relative">
                        <input type="email" wire:model="email"
                            class="w-full pl-9 pr-3 py-2 text-sm border border-rose-100 rounded-lg focus:ring-2 focus:ring-rose-300 focus:border-rose-300 bg-white/50 text-rose-900 placeholder-rose-300 transition duration-200"
                            placeholder="your@email.com">
                    </div>
                </div>

                {{-- Password Field --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-rose-900/80 mb-1">Password</label>
                    <div class="relative">
                        <input type="password" wire:model="password"
                            class="w-full pl-9 pr-3 py-2 text-sm border border-rose-100 rounded-lg focus:ring-2 focus:ring-rose-300 focus:border-rose-300 bg-white/50 text-rose-900 placeholder-rose-300 transition duration-200"
                            placeholder="••••••••">
                    </div>
                </div>

                {{-- Remember Me & Forgot Password --}}
                <div class="flex items-center justify-between text-xs">
                    <div class="flex items-center">
                        <input id="remember-me" type="checkbox"
                            class="h-3 w-3 text-rose-400 focus:ring-rose-300 border-rose-200 rounded">
                        <label for="remember-me" class="ml-2 block text-rose-700/70">Remember me</label>
                    </div>
                    <div>
                        <a href="#" class="font-medium text-rose-500 hover:text-rose-700">Forgot password?</a>
                    </div>
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                    class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-lg text-sm text-white bg-gradient-to-r from-rose-400 to-amber-400 hover:from-rose-500 hover:to-amber-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-300 transition-all duration-300">
                    <span wire:loading.remove wire:target="login">
                        Sign In
                    </span>
                    <span wire:loading wire:target="login" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-3 w-3 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Preparing Your Routine...
                    </span>
                </button>
            </div>

            {{-- Sign Up Link --}}
            <div class="mt-6 text-center text-xs">
                <p class="text-rose-700/70">
                    New to our beauty community?
                    <button type="button" wire:click="redirectToSignup"
                        class="font-medium text-rose-500 hover:text-rose-700 hover:underline">
                        Begin your skincare journey
                    </button>
                </p>
            </div>
        </form>
    </div>
</div>