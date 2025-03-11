<div class="w-full max-w-md mx-auto">
    <form wire:submit.prevent="register">
        <h2 class="text-center text-2xl font-bold mb-4">Sign Up</h2>

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" wire:model="name" id="name" class="w-full p-2 border rounded">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" wire:model="email" id="email" class="w-full p-2 border rounded">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" wire:model="password" id="password" class="w-full p-2 border rounded">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
            <input type="password" wire:model="password_confirmation" id="password_confirmation" class="w-full p-2 border rounded">
            @error('password_confirmation') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Sign Up</button>

        @if (session()->has('error'))
            <p class="text-red-500 mt-2">{{ session('error') }}</p>
        @endif
    </form>
</div>
