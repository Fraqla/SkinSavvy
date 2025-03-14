<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
    <h2 class="mb-6 text-2xl font-bold text-gray-700">Sign Up</h2>

    <form wire:submit.prevent="register" class="w-full max-w-md bg-white p-8 shadow-md rounded">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
            <input type="text" wire:model="name" class="w-full px-4 py-2 border rounded-md" placeholder="Your name">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" wire:model="email" class="w-full px-4 py-2 border rounded-md" placeholder="you@example.com">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
            <input type="password" wire:model="password" class="w-full px-4 py-2 border rounded-md" placeholder="******">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirm Password</label>
            <input type="password" wire:model="password_confirmation" class="w-full px-4 py-2 border rounded-md" placeholder="******">
        </div>

        <!-- Role Dropdown -->
        <div class="mb-4">
            <label for="role" class="block text-gray-700 font-medium mb-2">Role</label>
            <select wire:model="role" class="w-full px-4 py-2 border rounded-md">
                <option value="admin_consultant">Admin Consultant</option>
            </select>
            @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-md">
            Sign Up
        </button>

        <p class="mt-4 text-sm text-gray-600">Already have an account? 
            <a href="{{ route('sign-in') }}" class="text-blue-500 hover:underline">Sign In</a>
        </p>
    </form>
</div>