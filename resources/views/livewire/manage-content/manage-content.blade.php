<div class="flex min-h-screen bg-gradient-to-br from-pink-50 to-purple-50">
    {{-- Sidebar --}}
    @livewire('sidebar')

    <div class="flex-1 p-6 overflow-auto">
        <div class="max-w-6xl mx-auto">
            {{-- Header --}}
            <div class="mb-8 text-center md:text-left">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 font-serif">Content Management</h1>
                <p class="text-lg text-gray-600 mt-2">Organize and update your skincare knowledge base</p>
                <div class="w-24 h-1 bg-gradient-to-r from-pink-400 to-purple-500 rounded-full mt-4 mx-auto md:mx-0"></div>
            </div>

            {{-- Content Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $contentLinks = [
                        'Skin Knowledge' => [
                            'route' => 'manage-content.skin-knowledge.skinknowledge',
                            'color' => 'from-blue-400 to-blue-600',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>'
                        ],
                        'Skin Quiz' => [
                            'route' => 'manage-content.skinquiz',
                            'color' => 'from-green-400 to-green-600',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>'
                        ],
                        'Ingredient Analysis' => [
                            'route' => 'manage-content.ingredient',
                            'color' => 'from-yellow-400 to-yellow-600',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>'
                        ],
                        'Tips' => [
                            'route' => 'manage-content.tips',
                            'color' => 'from-purple-400 to-purple-600',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>'
                        ],
                        'Promotion' => [
                            'route' => 'manage-content.promotion',
                            'color' => 'from-pink-400 to-rose-600',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z" /></svg>'
                        ],
                        'Prohibited Products' => [
                            'route' => 'manage-content.prohibited',
                            'color' => 'from-gray-400 to-gray-600',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>'
                        ]
                    ];
                @endphp

                @foreach ($contentLinks as $title => $linkData)
                    <a href="{{ route($linkData['route']) }}"
                        class="group relative overflow-hidden bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                        <div class="absolute inset-0 bg-gradient-to-br {{ $linkData['color'] }} opacity-10 group-hover:opacity-20 transition-opacity duration-300"></div>
                        <div class="relative p-6 flex items-start space-x-4">
                            <div class="flex-shrink-0 bg-gradient-to-br {{ $linkData['color'] }} p-3 rounded-lg text-white">
                                {!! $linkData['icon'] !!}
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800">{{ $title }}</h3>
                                <p class="mt-1 text-gray-600">Manage {{ strtolower($title) }} content</p>
                                <div class="mt-3 inline-flex items-center text-sm font-medium text-{{ str_replace('from-', '', explode(' ', $linkData['color'])[0]) }}-600 group-hover:text-{{ str_replace('from-', '', explode(' ', $linkData['color'])[0]) }}-700 transition-colors duration-200">
                                    View section
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>