<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
    <h2 class="mb-6 text-2xl font-bold text-gray-700">Sign In</h2>

    {{-- Success & Error Messages --}}
    @if (session()->has('message'))
        <div class="mb-4 w-full max-w-md bg-green-100 text-green-700 p-3 rounded-md shadow-sm">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 w-full max-w-md bg-red-100 text-red-700 p-3 rounded-md shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- Sign In Form --}}
    <form wire:submit.prevent="login" class="w-full max-w-md bg-white p-8 shadow-md rounded">
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

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-md">
            Sign In
        </button>

        <p class="mt-4 text-sm text-gray-600">
            Don’t have an account? 
            <button type="button" wire:click="redirectToSignup" class="text-blue-500 hover:underline">Sign Up</button>
        </p>
    </form>
</div>
