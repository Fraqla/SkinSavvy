<div class="flex min-h-screen bg-gradient-to-br from-pink-50 to-purple-50">
    {{-- Sidebar --}}
    @livewire('sidebar')

    <div class="flex-1 p-6 overflow-auto flex items-center justify-center">
        <div class="max-w-md w-full bg-white rounded-xl shadow-lg overflow-hidden border border-pink-100">
            <!-- Decorative header -->
            <div class="bg-gradient-to-r from-pink-400 to-purple-500 p-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>

            <!-- Content -->
            <div class="p-8 text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-4 font-serif">Welcome to SkinSavvy!</h2>
                
                <div class="mb-6 text-pink-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <p class="text-gray-600 mb-6 leading-relaxed">
                    Your account has been created successfully. Our team is reviewing your registration and will notify you via email once your account is activated.
                </p>

                <p class="text-sm text-gray-500 mb-8">
                    Typically this takes 1-2 business days. Thank you for your patience!
                </p>

                <div class="bg-pink-50 border-l-4 border-pink-400 p-4 text-left rounded-r-lg mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-pink-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-pink-700">
                                Check your spam folder if you don't receive our email within 48 hours.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>