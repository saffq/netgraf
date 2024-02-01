@extends('layouts.app')

@section('title', 'Pets List')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold">Pets List</h1>
            <p>
                <a href="{{ route('pets.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add a new pet
                </a>
            </p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($pets as $pet)
                <div class="bg-white rounded-lg overflow-hidden shadow-md mb-4">
                    <a href="{{ route('pets.show', $pet['id']) }}" class="block h-12 relative overflow-hidden">
                    </a>
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">
                            <a href="{{ route('pets.show', $pet['id']) }}" class="hover:underline">{{ $pet['name'] }}</a>
                        </h2>
                        <p class="text-gray-600">{{ $pet['status'] }}</p>
                    </div>
                    <div class="bg-gray-200 text-center py-2">
                        <a href="{{ route('pets.show', $pet['id']) }}" class="text-blue-500 hover:underline">Show</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

