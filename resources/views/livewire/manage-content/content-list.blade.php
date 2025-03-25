<div class="flex h-screen bg-gray-100">
    {{-- Sidebar --}}
    @livewire('sidebar')

    <div class="p-4 w-full overflow-auto">
        <h1 class="text-2xl font-bold mb-6">Manage Content</h1>

        <div class="grid grid-cols-3 gap-4">
            @foreach (['Skin Knowledge', 'Skin Quiz', 'Ingredient Analysis', 'Tips', 'Promotion', 'Prohibited Products'] as $content)
                <a href="{{ route('manage-content.' . Str::slug($content)) }}" 
                   class="p-6 bg-white shadow-lg rounded-lg flex flex-col items-center justify-center hover:bg-blue-100 transition">
                    <h2 class="text-lg font-semibold">{{ $content }}</h2>
                </a>
            @endforeach
        </div>
    </div>
</div>
