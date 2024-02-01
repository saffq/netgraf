@extends('layouts.app')

@section('title', "Pet Details: {$pet['name']}")

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-semibold mb-6">Pet Details: {{ $pet['name'] }}</h1>

        <div class="bg-white rounded-lg overflow-hidden shadow-md mb-4 p-4">
            <p class="text-xl font-semibold mb-2">Name: {{ $pet['name'] }}</p>
            <p class="text-xl font-semibold mb-2">Status: {{ $pet['status'] }}</p>
        </div>

        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('pets.edit', $pet['id']) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Edit Pet
            </a>

            <form action="{{ route('pets.destroy', $pet['id']) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this pet?')">
                @csrf
                @method('delete')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete Pet</button>
            </form>
        </div>
        <p><a href="{{ route('pets.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Pets</a></p>
    </div>
@endsection
