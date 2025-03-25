@if($showSkinDetails)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 relative">
            <h2 class="text-2xl font-bold mb-4">Skin Knowledge Details</h2>

            <p><strong>Skin Type:</strong> {{ $skinDetails['skin_type'] }}</p>
            <p><strong>Characteristics:</strong> {{ $skinDetails['characteristics'] }}</p>
            <p><strong>Best Ingredients:</strong> {{ $skinDetails['best_ingredient'] }}</p>

            <img src="{{ asset('storage/' . $skinDetails['image']) }}" alt="Skin Image" class="w-32 h-32 object-cover rounded">


            <button wire:click="closeDetails"
                class="absolute top-2 right-2 bg-red-500 text-white py-1 px-2 rounded-full hover:bg-red-600">
                ✖️
            </button>
        </div>
    </div>
@endif
