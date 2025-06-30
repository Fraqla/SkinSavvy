<div class="w-64 bg-gradient-to-b from-purple-900 to-pink-800 min-h-screen text-white shadow-xl">
    <!-- Logo/Branding -->
    <div class="p-6 border-b border-pink-700 flex items-center space-x-3">
        <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-pink-300 to-purple-200">
            SkinSavvy Admin
        </span>
    </div>

    <!-- Navigation Menu -->
    <ul class="mt-6 space-y-1 px-3">
        @can('manage content')
        @if(auth()->user()->status === 'active')
        <li>
            <a href="{{ route('manage-content') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg hover:bg-pink-700 hover:bg-opacity-50 transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-pink-300 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Manage Content
            </a>
        </li>
        @endif
        @endcan

        @can('waiting approval')
        @if(auth()->user()->status === 'pending')
        <li>
            <a href="{{ route('waiting-approval') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg hover:bg-pink-700 hover:bg-opacity-50 transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-pink-300 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Waiting Approval
                <span class="ml-auto bg-pink-600 text-white text-xs font-bold px-2 py-1 rounded-full">3</span>
            </a>
        </li>
        @endif
        @endcan

   

        @can('manage roles')
        @if(auth()->user()->status === 'active')
        <li>
            <a href="{{ route('manage-roles') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg hover:bg-pink-700 hover:bg-opacity-50 transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-pink-300 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Manage Permissions
            </a>
        </li>
        @endif
        @endcan

        @can('admin approval')
        @if(auth()->user()->status === 'active')
        <li>
            <a href="{{ route('admin-approval') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg hover:bg-pink-700 hover:bg-opacity-50 transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-pink-300 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                Admin Consultant
            </a>
        </li>
        @endif
        @endcan

        @can('manage product')
        @if(auth()->user()->status === 'active')
        <li>
            <a href="{{ route('manage-product') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg hover:bg-pink-700 hover:bg-opacity-50 transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-pink-300 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                Manage Products
            </a>
        </li>
        @endif
        @endcan

        @can('manage category')
        @if(auth()->user()->status === 'active')
        <li>
            <a href="{{ route('manage-category') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg hover:bg-pink-700 hover:bg-opacity-50 transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-pink-300 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Manage Categories
            </a>
        </li>
        @endif
        @endcan

        @can('manage user')
        @if(auth()->user()->status === 'active')
        <li>
            <a href="{{ route('manage-user') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg hover:bg-pink-700 hover:bg-opacity-50 transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-pink-300 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Manage Users
            </a>
        </li>
        @endif
        @endcan
    </ul>
</div>