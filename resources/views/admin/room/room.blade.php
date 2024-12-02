<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
    <h1 style="color: white">User List</h1>
    <table  style="color: black">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Places</th>
                <th>Beds</th>
                <th>Price each night</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->roomId }}</td>
                    <td>{{ $room->roomType }}</td>
                    <td>{{ $room->places }}</td>
                    <td>{{ $room->beds}}</td>
                    <td>{{ $room->price }}</td>
                    <td>  <x-primary-button class="ms-1"><a href="{{ route('room.edit', ['roomId' => $room->roomId]) }}">Edit</a></x-primary-button></td>
                    <td>
                    <form action="{{ route('room.destroy', $room->roomId) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this room?');">
                        @csrf
                        @method('DELETE') <!-- This specifies the request method as DELETE -->
                        <x-primary-button class="bg-red-500">
                            Delete
                        </x-primary-button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <x-primary-button class="ms-1">
        <a href="{{ route('room.create') }}" class="text-white no-underline">
            Add a new room
        </a>
    </x-primary-button>

                </div>
            </div>
        </div>
    </div>

    </x-app-layout>

