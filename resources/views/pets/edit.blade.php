@extends('layouts.app')

@section('title', "Edit Pet: {$pet['name']}")

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-semibold mb-6">Edit Pet: {{ $pet['name'] }}</h1>

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('pets.update', $pet['id']) }}" method="post">
            @csrf
            <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
            <input type="text" name="name" value="{{ $pet['name'] }}" required class="mt-1 p-2 w-full border rounded-md">

            <label for="status" class="block text-sm font-medium text-gray-700 mt-4">Status:</label>
            <input type="text" name="status" value="{{ $pet['status'] }}" required class="mt-1 p-2 w-full border rounded-md">

            <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update Pet
            </button>
        </form>

        <p class="mt-4"><a href="{{ route('pets.index') }}" class="text-blue-500 hover:underline">Back to Pets</a></p>
    </div>
@endsection
