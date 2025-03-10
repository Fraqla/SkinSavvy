
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-4">Sign In</h2>

        @if (session()->has('error'))
            <div class="bg-red-500 text-white p-2 rounded mb-3">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="login">
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Email</label>
                <input type="email" wire:model="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none" required>
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Password</label>
                <input type="password" wire:model="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none" required>
                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Sign In
            </button>
        </form>
    </div>
</div>
