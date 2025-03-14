<div class="w-64 bg-gray-800 min-h-screen text-white">
    <div class="p-4 text-xl font-bold border-b border-gray-700">
        Admin Dashboard
    </div>
    <ul class="mt-4 space-y-2">
        <li>
        <a href="{{ route('manage-content') }}"class="block px-4 py-2 hover:bg-gray-700">Manage Content</a>
        </li>
        <li>
            <a href="{{ route('manage-product') }}" class="block px-4 py-2 hover:bg-gray-700">Manage Product</a>
        </li>
        <li>
            <a href="{{ route('manage-promotion') }}" class="block px-4 py-2 hover:bg-gray-700">Manage Promotion News</a>
        </li>
        <li>
            <a href="{{ route('waiting-approval') }}" class="block px-4 py-2 hover:bg-gray-700">Waiting Approval</a>
        </li>
    </ul>
</div>
