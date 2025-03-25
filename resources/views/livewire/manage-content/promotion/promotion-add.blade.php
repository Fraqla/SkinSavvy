<!-- add-promotion.blade.php -->
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" wire:ignore.self>
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-semibold mb-4">Add Promotion</h2>

        <form wire:submit.prevent="save" class="space-y-4">
            <input type="text" wire:model="title" placeholder="Title" class="w-full border rounded p-2">
            <textarea wire:model="description" placeholder="Description" class="w-full border rounded p-2"></textarea>
            <input type="date" wire:model="start_date" class="w-full border rounded p-2">
            <input type="date" wire:model="end_date" class="w-full border rounded p-2">
            <input type="file" wire:model="image" class="w-full border rounded p-2">

            <div class="flex justify-end space-x-2">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save</button>
                <button type="button" wire:click="$dispatch('hide-add-promotion')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
    Cancel
</button>

            </div>
        </form>
    </div>
</div>
