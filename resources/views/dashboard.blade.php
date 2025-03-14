@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    {{-- Sidebar --}}
    @livewire('sidebar')

    {{-- Main Content --}}
    <div class="flex-1 p-6">
        <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
            <h2 class="text-2xl font-bold text-gray-700 mb-6">Welcome to your Dashboard!</h2>
            <a href="{{ route('sign-in') }}" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md">Log Out</a>
        </div>

        <div class="grid grid-cols-3 gap-6 mt-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold">Total Users</h2>
                <p class="text-3xl font-bold">120</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold">Total Products</h2>
                <p class="text-3xl font-bold">35</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold">Total Sales</h2>
                <p class="text-3xl font-bold">$15,230</p>
            </div>
        </div>
    </div>
</div>
@endsection
