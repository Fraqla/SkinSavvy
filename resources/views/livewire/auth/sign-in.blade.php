<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <!-- Logo -->
    <div class="mb-6">
    <img src="{{ asset('images/skin-savvy-logo.png') }}" alt="My Logo" class="h-20 w-auto mx-auto">
    </div>

    <!-- Sign In Form -->
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-center text-2xl font-bold text-gray-700 mb-6">Sign In</h2>

        <!-- Form Start -->
        <form wire:submit.prevent="login">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" wire:model="email" id="email" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" wire:model="password" id="password" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition duration-200">
                Sign In
            </button>
        </form>
        <!-- Form End -->
    </div>
</div>
