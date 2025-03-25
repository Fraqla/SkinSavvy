<div class="flex h-screen bg-gray-100">
    {{-- Sidebar --}}
    @livewire('sidebar')

    <div class="p-4 space-y-4">
    <h1 class="text-xl font-semibold mb-4">Manage Content</h1>

    <div class="grid grid-cols-2 gap-4">
        <a href="{{ route('manage-content.skin-knowledge.skinknowledge') }}" class="p-4 bg-blue-500 text-white rounded-lg text-center">Skin Knowledge</a>
        <a href="{{ route('manage-content.skinquiz') }}" class="p-4 bg-green-500 text-white rounded-lg text-center">Skin Quiz</a>
        <a href="{{ route('manage-content.ingredient') }}" class="p-4 bg-yellow-500 text-white rounded-lg text-center">Ingredient Analysis</a>
        <a href="{{ route('manage-content.tips') }}" class="p-4 bg-purple-500 text-white rounded-lg text-center">Tips</a>
        <a href="{{ route('manage-content.promotion') }}" class="p-4 bg-red-500 text-white rounded-lg text-center">Promotion</a>
        <a href="{{ route('manage-content.prohibited') }}" class="p-4 bg-gray-500 text-white rounded-lg text-center">Prohibited Products</a>
    </div>
</div>

</div>
