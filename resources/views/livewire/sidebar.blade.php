<div class="w-64 bg-gray-800 min-h-screen text-white">
    <div class="p-4 text-xl font-bold border-b border-gray-700">
        Admin Dashboard
    </div>
    <ul class="mt-4 space-y-2">
    @can('manage content')
    <li>
        <a href="{{ route('manage-content') }}" class="block px-4 py-2 hover:bg-gray-700">Manage Content</a>
    </li>
@endcan

@can('manage promotion news')
    <li>
        <a href="{{ route('manage-promotion') }}" class="block px-4 py-2 hover:bg-gray-700">Manage Promotion News</a>
    </li>
@endcan

@can('waiting approval')
    <li>
        <a href="{{ route('waiting-approval') }}" class="block px-4 py-2 hover:bg-gray-700">Waiting Approval</a>
    </li>
@endcan

@can('manage roles')
    <li>
        <a href="{{ route('manage-roles') }}" class="block px-4 py-2 hover:bg-gray-700">Manage Roles</a>
    </li>
@endcan

@can('admin approval')
    <li>
        <a href="{{ route('admin-approval') }}" class="block px-4 py-2 hover:bg-gray-700">Admin Consultant</a>
    </li>
@endcan

@can('manage product')
    <li>
        <a href="{{ route('manage-product') }}" class="block px-4 py-2 hover:bg-gray-700">Manage Product</a>
    </li>
@endcan

@can('manage category')
    <li>
        <a href="{{ route('manage-category') }}" class="block px-4 py-2 hover:bg-gray-700">Manage Category</a>
    </li>
@endcan

@can('manage user')
    <li>
        <a href="{{ route('manage-user') }}" class="block px-4 py-2 hover:bg-gray-700">Manage User</a>
    </li>
@endcan

    </ul>
</div>
